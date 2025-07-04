<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller{
    function getApiData(Request $request){
            $limit  = $request->query('limit'); 
            $skip   = $request->query('skip');
            $response = Http::get('https://dummyjson.com/posts?limit=' . $limit. '&skip=' . $skip);
            if ($response->successful()) {
                $data = $response->json();
                // return or process data
                return response()->json([ "statusCode"  => 200,
                                            "message"   => "success",
                                            "data"      =>$data]);
            } else {
                // handle error
                return response()->json(['error' => 'Failed to fetch data'], 500);
            }
        }
}
?>