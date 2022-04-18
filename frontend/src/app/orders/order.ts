export interface IOrder {
  order_id: number;
  order_sum: number;
  order_time: string;
  order_items: IOrderItem[];
}

export interface IOrderItem {
  id: number;
  quantity: number;
  name: string;
  price: number;
  ingredients: string[];
}
