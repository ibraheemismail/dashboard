<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use DB;

class ProductController extends Controller
{
    public function addProduct(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->all();
    		//echo "<pre>"; print_r($data); die;
    		$product = new Product;
            $product->name = $data['product_name'];
           // $category->parent_id = $data['parent_id'];
    		$product->pro_num = $data['pro_num'];
    		$product->url = $data['url'];
    		$product->save();
    		return redirect('/admin/view-product')->with('flash_message_success','Product added Successfully!');
    	}

        $levels = Product::where(['parent_id'=>0])->get();

    	return view('admin.product.add_product')->with(compact('levels'));
    }

    public function editProduct(Request $request, $id = null){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Product::where(['id'=>$id])->update(['name'=>$data['product_name'],'pro_num'=>$data['pro_num'],'url'=>$data['url']]);
            return redirect('/admin/view-product')->with('flash_message_success','Product updated Successfully!');
        }
        $productDetails = Product::where(['id'=>$id])->first();
        $levels = Product::where(['parent_id'=>0])->get();
        return view('admin.product.edit_product')->with(compact('productDetails','levels'));
    }

    public function deleteProduct(Request $request, $id = null){
        if(!empty($id)){
            Product::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Product deleted Successfully!');
        }
    }

    public function viewProduct(){

    	$product = Product::get();
    	$product = json_decode(json_encode($product));
    	/*echo "<pre>"; print_r($categories); die;*/
    	return view('admin.product.view_product')->with(compact('product'));
    }

   
}
