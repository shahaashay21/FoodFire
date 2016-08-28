<?php
// TO ALLOW CROSS ORIGIN RESOURCE SHARE (REPLY ON REST API)
//header("Access-Control-Allow-Origin: *");

class ProductDetails extends BaseController{
	
	
	public function main(){
		//Log::info("Class name: ".get_class($this)." and Function name: ".__FUNCTION__);

		$productid = Input::get('productid');

		$pro = DB::table('fd_items as fi')
				->leftJoin('cf_items as ci', 'ci.itemunkid', '=', 'fi.itemunkid')
				->where('fi.id', '=', $productid)->get();

		$pro = json_decode(json_encode($pro),1);

		$diet = explode(',',$pro[0]['food_diet']);
		$taste = explode(',',$pro[0]['food_taste']);

		$subitem = DB::table('fd_subitems')
					->where('itemid', '=', $productid)->get();

		$subitem = json_decode(json_encode($subitem),1);
		// Log::info($subitem);

		$subitem_cat = DB::table('fd_subitems')
					->select('category')
					->where('itemid', '=', $productid)->distinct()->get();

		$subitem_cat = json_decode(json_encode($subitem_cat),1);
		// Log::info($subitem_cat);

$product['product'] = '<form name="item" class="itemForm" onSubmit="return addProduct()">
						<div class="modal fade" tabindex="-1" id="productModal" role="dialog">
					    <div class="modal-dialog">
					    
					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">'.ucwords($pro[0]['name']).'</h4>
					        </div>
					        <div class="modal-body" style="max-height:400px; overflow-y: scroll;">
					        	<div class="container-fluid">
						        	<div class="row">
							          <div class="col-xs-12">'.$pro[0]['pro_description'].'</div>';
							          for($i=0; $i<count($subitem_cat); $i++){
							          		$category_name = false;
							          		$product['product'] .= '<div class="col-xs-12" style="margin:10px 0">
							          									<span style="font-weight:bold">'.ucwords($subitem_cat[$i]['category']).':</span>';
							          		for($j=0; $j<count($subitem); $j++){
							          			if(ucwords($subitem_cat[$i]['category']) == ucwords($subitem[$j]['category'])){
							          				$product['product'] .= '<div class="col-xs-12">
							          											<input type="'.ucwords($subitem[$j]['subitem_type']).'" name="'.ucwords($subitem[$j]['category']).'[]" value="'.ucwords($subitem[$j]['subitemid']).'">
							          											<span> '.ucwords($subitem[$j]['item_name']).'</span>';
							          											if($subitem[$j]['item_price'] != null || $subitem[$j]['item_price'] != ''){
							          												$product['product'] .=	'<span> (<i class="fa fa-inr"></i> '.ucwords($subitem[$j]['item_price']).'.00)</span>';
							          											}
							          				
							          				$product['product'] .=  '</div>';
							          			}
							          			// $product['product'] .= '<span style="font-weight:bold">Category:</span>';
							          		}
							          		$product['product'] .=  '</div>';
							          }
			
							          if($pro[0]['pro_description'] != null || $pro[0]['pro_description'] != ''){
							          	$product['product'] .=   '<br><br>';
							          }
					

		$product['product'] .=        '<div class="col-xs-12" style="margin:10px 0"><span style="font-weight:bold">Food Diet: </span>';
							          if(sizeof($diet) == 1){
			  $product['product'] .= 	 '<span>'.ucwords($diet[0]).'</span></div>
			  								<input type="hidden" name="food_diet" value="'.ucwords($diet[0]).'">';
	          						  }else{
			$product['product'] .=      '</div><div class="col-xs-12">
								          	<div class="btn-group" data-toggle="buttons">';

									          for($j=0; $j < sizeof($diet); $j++){
		$product['product'] .= 				        '<label class="btn btn-default-edit '; 
													   	if($diet[$j] == 'Vegetarian'){
		$product['product'] .=                             'active';
							    					    }
		$product['product'] .= 						'">
							    						<input ';
							    						if($diet[$j] == 'Vegetarian'){
		$product['product'] .=                             'checked="checked"';
							    					    }
		$product['product'] .= 						' type="radio" name="food_diet" value="'.ucwords($diet[$j]).'" >
			 											'.ucwords($diet[$j]).'
							  						</label>';
									          }
		$product['product'] .=       	    '</div>
										</div>';
									   }
		$product['product'] .=			'<div class="col-xs-12" style="margin:10px 0"><span style="font-weight:bold">Food Taste: </span>';

								       if(sizeof($taste) == 1){
			  $product['product'] .= 	 '<span>'.$taste[0].'</span></div> 
			  								<input type="hidden" name="food_taste" value="'.ucwords($taste[0]).'">';
									   }else{
		$product['product'] .=			'</div><div class="col-xs-12">
											<div class="btn-group" data-toggle="buttons">';

									          for($j=0; $j < sizeof($taste); $j++){
		$product['product'] .= 				        '<label class="btn btn-default-edit '; 
													   	if($taste[$j] == 'Medium'){
		$product['product'] .=                             'active';
							    					    }
		$product['product'] .= 						'">
							    						<input ';
							    						if($taste[$j] == 'Medium'){
		$product['product'] .=                             'checked="checked"';
							    					    }
		$product['product'] .=                      ' type="radio" name="food_taste" value="'.ucwords($taste[$j]).'" >
			 											'.ucwords($taste[$j]).'
							  						</label>';
									          }
		$product['product'] .=       	    '</div>
										</div>';
									   }
		$product['product'] .=	    '</div>
							    </div>
							</div>
		   			        <div class="modal-footer">
			   			        
		   			        	<input type="hidden" name="itemid" value="'.$productid.'">
		   			        	<span style="float:left">
		   			        		Qty
		   			        		<input type="text" name="qty" value="1" class="input_text_box item-modal-input">
		   			        		<i class="fa fa-inr"></i><span> '.$pro[0]['price'].'</span>
		   			        	</span>
			   			        
					          <button type="button" class="btn-edit btn-danger" data-dismiss="modal">Close</button>
					          <input type="submit" value="Add to cart" class="btn-edit btn-success">
					        </div>
					      </div>
					      
					    </div>
					  </div>
					  </form>';

		$product['modal'] = 1;

		return json_encode($product);

	}
}