<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadCsvRequest;
use Illuminate\Support\Facades\Storage;
use App\Jobs\UploadBulkCsvProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class IndexController extends Controller
{

    /**
     * This calls the view to enable bulk upload of the csv files
     */
    public function upload()
    {
        return view('uploadCsv.index');
    }

    /**
     * Uploads the file and Creates jobs and dipatches them
     * to handle the uplooad in a console thread
     * when php artisan queue:work is ran.
     * 
     */
    public function uploadCsvFile(UploadCsvRequest $request)
    {

        $data   =   file($request->csvFile);
        // Chunking file
        $chunks = array_chunk($data, 10000);

        $header = [];

        foreach ($chunks as $key => $chunk) {

            $data = array_map('str_getcsv', $chunk);

            if($key === 0){

                $header = ['invoice_no', 'stock_code', 'description', 'quantity', 'invoice_date', 'unit_price', 'customer_id', 'country'];

                unset($data[0]);
            }

            UploadBulkCsvProcess::dispatch($data, $header);
        }

        return redirect()->back()->with('message', 'File Successfully Uploaded and Jobs Dispatched. Please run Queue Work to commit to Database');
    }

    /**
     * Loads the characters from the cache files that was called
     * when the cached was created in the console command
     * 
     */
    public function characters()
    {
        
        $characters = Cache::get('characters');  
    
        $current_page = LengthAwarePaginator::resolveCurrentPage();
    
        if(is_null($current_page)){
            $current_page = 1;
        }
    
        $characters_collection = new Collection($characters);
    
        $items_per_page = 8;
    
        $current_page_results = $characters_collection->slice(($current_page - 1) * $items_per_page, $items_per_page)->all();
        
        $paginated_results = new LengthAwarePaginator($current_page_results, count($characters_collection), $items_per_page);
    
        return view('loadCharacters.index', ['paginated_results' => $paginated_results, 'characters' => $characters]);
    
    }

}
