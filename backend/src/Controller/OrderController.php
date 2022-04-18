<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\OrderItems;
use App\Entity\Pizza;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class OrderController extends AbstractController
{

    #[Route('/orders', name: 'get_orders', methods: "GET")]
    public function get_orders(EntityManagerInterface $em): Response
    {
        $conn = $em->getConnection();
        $sql = 'SELECT o.id, oi.pizza_id,oi.quantity, p.name, p.price,i.name as ingredient
                FROM orders o
                JOIN order_items oi ON oi.id = o.order_item_id
                JOIN pizza p ON oi.pizza_id = p.id
                JOIN pizza_ingredients_rels pir ON pir.pizza_id = p.id
                JOIN ingredients i ON pir.ingredients_id = i.id';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
        $result = $resultSet->fetchAllAssociative();

        $orders = [];
        if (is_array($result)) {
            for ($i = 0; $i < sizeof($result); $i++) {
                $orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["quantity"] = $result[$i]["quantity"];
                $orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["price"] = $result[$i]["price"];
                $orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["name"] = $result[$i]["name"];
                if (!isset($orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["ingredients"])) {
                    $orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["ingredients"] = [];
                }
                array_push(
                    $orders[$result[$i]["id"]]["order_items"][$result[$i]["pizza_id"]]["ingredients"],
                    $result[$i]["ingredient"]
                );
            }
        }
        $orders_arr = [];
        foreach ($orders as $order_id => $order) {
            $order_sum = 0;
            $order_items = [];
            foreach ($order["order_items"] as $pizza_id => $pizza) {
                $order_sum += $pizza["quantity"] * $pizza["price"];
                $pizza["id"] = $pizza_id;
                array_push($order_items, $pizza);
            }
            $order["order_sum"] = $order_sum;
            $order["order_id"] = $order_id;
            $order["order_time"] = date("H:i:s d.m.Y", $order_id);
            $order["order_items"] = $order_items;
            array_push($orders_arr, $order);
        }

        uasort($orders_arr, function ($a, $b) {
            return $b["order_id"] - $a["order_id"];
        });

        $orders_sorted = [];
        foreach ($orders_arr as $order) {
            array_push($orders_sorted, $order);
        }
        return $this->json($orders_sorted);
    }

    #[Route('/order', name: 'create_order', methods: "POST")]
    public function create_order(EntityManagerInterface $em, Request $request): Response
    {
        $conn = $em->getConnection();
        $order_id = time();
        $order = json_decode($request->getContent());
        $order_items = [];
        for ($i = 0; $i < sizeof($order); $i++) {
            if (!isset($order_items[$order[$i]->id])) $order_items[$order[$i]->id] = 0;
            $order_items[$order[$i]->id]++;
        }
        foreach ($order_items as $pizza_id => $quantity) {
            $sql = 'INSERT INTO `order_items` (`pizza_id`, `quantity`) VALUES (:pizza_id,:quantity)';
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery(['pizza_id' => $pizza_id, 'quantity' => $quantity]);
            $resultSet->fetchAllAssociative();

            $order_item_id = $conn->lastInsertId();
            $sql = 'INSERT INTO `orders` (`id`, `order_item_id`) VALUES (:id,:order_item_id)';
            $stmt = $conn->prepare($sql);
            $resultSet = $stmt->executeQuery(['id' => $order_id, 'order_item_id' => $order_item_id]);
            $resultSet->fetchAllAssociative();
        }


        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PizzaController.php',
        ]);
    }
}
