<?php

namespace App\Http\Controllers\Admin\Common;

use App\Models\Bundle;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
  public function getProductBundle(Request $request)
  {
    
    if ($request->product_type == 0) {
      $data = Product::select('id', 'name')->where('created_by', auth()->user()->id)->get();
    } else if ($request->product_type == 1) {
        $data = Bundle::select('id', 'name')->where('created_by', auth()->user()->id)->get();
    }
    // return json_encode($data);
    $html='';
    foreach ($data as $key => $value) {
      $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';
    }
    return $html;
   
  }
}
