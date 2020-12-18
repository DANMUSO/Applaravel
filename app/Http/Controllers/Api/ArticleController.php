<?php

namespace App\Http\Controllers\Api;

require_once(__DIR__.'/../../../../vendor/autoload.php');
use AfricasTalking\SDK\AfricasTalking;
use Http\Adapter\BuzzAdapter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
class ArticleController extends Controller
{
   public function savedata(Request $request){
   $article = new Article();
   $article->name=$request->name;
   $article->description=$request->description;
   $article->save();
   $response['Msg'] = "Data is saved successfully";
   echo json_encode($response);
   }
   public function retrievedata(){
      $article = Article::all();
      $response['Articles'] = $article;
      echo json_encode($response);
   }
   public function updatedata(Request $request, $id){
      $article= Article::find($id);
      $article->name=$request->name;
      $article->description=$request->description;
      $article->save();
      $response['Msg'] = "Data is updated successfully";
      echo json_encode($response);
   }
   public function destroy(Request $request, $id){
      $article = Article::findorFail($id);
      $article->delete();
      $response['Msg'] = $article;
      echo json_encode($response);

   }
   public function paymentAT(Request $request)
   {
      
      $username   = "sandbox";

      $apikey     ="ddad3641ef7445e8c4a38f37065c931882ea26c70c0e4ec2947b091e95a21431";
          // Initialize the SDK
      $AT         = new AfricasTalking($username, $apikey);

          // Get the payments service
      $payments   = $AT->payments();

          // Set the name of your Africa's Talking payment product
      $productName  = "XOOM GAS";

          // Set the phone number you want to send to in international format
      $phoneNumber  = $request->phone;
          // Set The 3-Letter ISO currency code and the checkout amount
      $currencyCode = "KES";
      $amount       = $request->amount;
      
          // Set any metadata that you would like to send along with this request.
          // This metadata will be included when we send back the final payment notification
          
      $metadata = [
      "custmerId"   =>  "custmerId",
      ];
          // Thats it, hit send and we'll take care of the rest.
       try {
       $result = $payments->mobileCheckout([
      "productName"  => $productName,
      "phoneNumber"  => $phoneNumber,
      "currencyCode" => $currencyCode,
      "amount"       => $amount,
      "metadata"     => $metadata
      ]);
      } catch(Exception $e) {
      echo "Error: ".$e->getMessage();
       }
   }
   
 
}
