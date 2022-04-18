<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Pizza;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

class PizzaController extends AbstractController
{

    #[Route('/pizzas', name: 'get_pizzas', methods: "GET")]
    public function get_pizzas(EntityManagerInterface $em): Response
    {

        $qb = $em->createQueryBuilder()
            ->select("p.id", "p.name", "p.price", "i.name AS ingredient")
            ->from("App\Entity\Pizza", "p")
            ->leftJoin("App\Entity\PizzaIngredientsRels", "ir", "WITH", "ir.pizza = p.id")
            ->leftJoin("App\Entity\Ingredients", "i", "WITH", "i.id = ir.ingredients");

        $query = $qb->getQuery();
        $result = $query->execute();

        $pizzas = [];
        for ($i = 0; $i < sizeof($result); $i++) {
            $pizzas[$result[$i]["id"]]["id"] = $result[$i]["id"];
            $pizzas[$result[$i]["id"]]["name"] = $result[$i]["name"];
            $pizzas[$result[$i]["id"]]["price"] = $result[$i]["price"];
            if (!isset($pizzas[$result[$i]["id"]]["ingredients"])) {
                $pizzas[$result[$i]["id"]]["ingredients"] = [];
            }
            array_push($pizzas[$result[$i]["id"]]["ingredients"], $result[$i]["ingredient"]);
        }
        $pizza_arr = [];
        foreach ($pizzas as $value) {
            array_push($pizza_arr, $value);
        }

        return $this->json($pizza_arr);
    }

    #[Route('/pizza', name: 'create_pizza', methods: "POST")]
    public function create_pizza(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $pizza = new Pizza();
        $pizza->setName('Margherita');
        // $pizza->setPrice(5);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($pizza);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PizzaController.php',
        ]);
    }
}
