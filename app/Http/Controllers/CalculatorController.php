<?php

namespace App\Http\Controllers;
// namespace is used to organise the classes into two different groups. 
// To preventing the ambguties.  If two class names are same Its confused which class is call. 
use Illuminate\Http\Request;
// laraval default or global pacakage is Illuminate,Http is sub package we will use Request.

use App\Models\Calculator;
use Illuminate\Support\Facades\DB;
class CalculatorController extends Controller
{
        /*
         * Update method  will put the record form database and
         * shows it to user in the form page
         */
    public function update($id){
        $record = Calculator::find($id);
        return view('calculator.update')->with('data',$record);
        }

        /**
         * savedata will put the upload values to databases
         */
        public function savedata($id){
            $record = Calculator::find($id);

           
            $record->a = request()->get('a');
            $record->b = request()->get('b');
            $record->opr = request()->get('opr');

            
            if(request()->get('opr')=='add')
             $record->result = $record->a + $record->b;
            else if(request()->get('opr')=='sub')
             $record->result = $record->a - $record->b;
            else if(request()->get('opr')=='mul')
             $record->result = $record->a * $record->b;
            else if(request()->get('opr')=='div')
             $record->result = $record->a / $record->b;

            $record->save();

            $alert = "You have successfully updated the record(" .$record->id. ")";

           return redirect()
           ->to('calculator/show/'.$id)
           ->with('alert',$alert);

        }

        /**
         * Method to delete one record from database
         */
        public function destroy($id){

            $record = Calculator::find($id);
            if($record)
                $record->delete();
            return redirect()->to('calculator/logs');
        }

        /*
         * form method will show the one record based on id
         */
    public function show($id){
        $alert = request()->session()->get('alert');
       // $record = DB::table('calculators')->where('id',$id)->first();
       // $record = DB::table('calculators')->find($id);
       $record = Calculator::find($id);
       return view('calculator.show')
       ->with('data',$record)
       ->with('alert',$alert);;
    }
    /**
     * method api 
     */
    public function api($id)
    {
         // $alert  = request()->session()->get('alert');
        // $r=DB::table('calculators')->where('id',$id)->first();
        //$r=DB::table('calculators')->find($id);
        $r=calculator::find($id);
        // dd($r);
       return $r;
    }
        /*
         * form method will show the form page from view
         */
    public function form(){
        return view('calculator.form');
        
    }

         /*
         * Result method will perform the operations
         * evaluate the result and then send the data to view.
         */
    public function result(){
        $a=request()->get('a');
        $b=request()->get('b');
        $opr=request()->get('opr');
        $result=null;

        if($opr=='add')
        $result=$a+$b;
        if($opr=='sub')
        $result=$a-$b;
        if($opr=='mul')
        $result=$a*$b;
        if($opr=='div')
        $result=$a/$b;

    // dd(request()->all());
    //  echo "<h1> done</h1>";
        //var_dump($a);  ->php we dont use another option didom
        //dd($a);  //this used for debugging to use dd

        // save this data in db table
        $calc=new Calculator(); //create model object
        $calc->a = $a;
        $calc->b = $b;
        $calc->opr = $opr;
        $calc->result = $result;
        $calc->save(); // save the record to table in db

        return view('calculator.result')
        ->with('result',$result)
        ->with('a',$a)
        ->with('b',$b)
        ->with('opr',$opr);
    }

    /**
     * this method is used for listing the logs from db table
     */
    public function logs(){
                // model object
        $calc =new Calculator(); 
        $data = $calc->all();
        return view('calculator.logs')->with('data' , $data);
        // dd($data);
        //    foreach($data as $d){
        //         echo $d->id . " - ";
        //         echo $d->a . " - ";
        //         echo $d->b. " - ";
        //         echo $d->opr. " - ";
        //         echo $d->result. " - ";
        //         echo $d->create_at. " - ";
        //         echo $d->updated_at. " - ";
        //         echo "<br>";
        //    } 
        //eloquent object name calc.  variable //condn value
        // $data = $calc->where('opr','!=', 'sub')->get();
        // $data = $calc->where('created_at','<=', '2023-07-02 13:05:47')->get();
        // $data = $calc->where('created_at','<=', '2023-07-02 13:05:47')
        //         ->where('opr','add')
        //         ->get();
        // $data = $calc->where('created_at','<=', '2023-07-02 13:05:47')
        //         ->get();
        // where is used as a condition of records on the table
        // get() will return a collection of records
        // first() will return the first record
        // $data = $calc->where('created_at','<=', '2023-07-02 13:05:47')
        //         ->first();
        // dd($data);
        // to get all records with some conditions on where
        // if(request()->get('all')==1){
        //     echo "all records<br><br>";
        //     $data = $calc->where('created_at','<=', '2023-07-02 13:05:47')
        //                  ->orderby('id','desc')
        //                  ->get();
        //      foreach($data as $d){
        //         echo "id - " . $d->id. "<br>";
        //         echo "a - " . $d->a. "<br>";
        //         echo "b - " . $d->b. "<br>";
        //         echo "opr - " . $d->opr. "<br>";
        //         echo "created_at - " . $d->created_at. "<br><br>";
        //      }            
        // }
        // if(request()->get('all')==0){
        //     echo "first record<br><br>";
        //     $d = $calc->where('created_at','<=', '2023-07-02 13:05:47')
        //                  ->first();

        //         echo "id - ". $d->id. "<br>";
        //         echo "a - ". $d->a. "<br>";
        //         echo "b - ". $d->b. "<br>";
        //         echo "opr - ". $d->opr. "<br>";
        //         echo "created_at - ". $d->created_at. "<br><br>";
           
        // }
        //dd($data);

      
        
    }
    public function queries(){
        // model object
      $calc =new Calculator(); 
      //$filter = all=>list all data
      //$filter = first=>display first record
      //$filter = last=>display last record
      //$filter = top,value=3 => display top 3 records
      //$filter = reverse =>display values in reverse order
      $filter = request()->get('filter');
      $value = request()->get('value');
      // to get all records with some conditions on where
        if($filter =='all'){
            $data = $calc->all();
            echo "All records : " .$data->count()."<br><br>";

             foreach($data as $d){
                echo "id - " . $d->id. "  |  ";
                echo "a - " . $d->a. "  |  ";
                echo "b - " . $d->b. "  |  ";
                echo "opr - " . $d->opr. "  |  ";
                echo "created_at - " . $d->created_at. "<br><br>";
             }            
        }
        //this will return first record
        if($filter == 'first'){
            echo "First record<br><br>";
            
            $d = $calc->where('created_at','<=', '2023-07-02 13:05:47')
                         ->first();
            // there are diff approches
            // $d = $calc->firstwhere('created_at','<=', '2023-07-02 13:05:47');
             //$d = $calc->find(1);

             //$d = $calc->where('id', 'desc')->max('created_at');
                echo "id - ". $d->id. "<br>";
                echo "a - ". $d->a. "<br>";
                echo "b - ". $d->b. "<br>";
                echo "opr - ". $d->opr. "<br>";
                echo "created_at - ". $d->created_at. "<br><br>";
        }

        // first record another approch
        if($filter == 'tenthrecord'){
            echo "Tenth record<br><br>";
            // Retrieve  id = 1 details
            $d = $calc::firstOrNew([
                'id' => '10'
            ]); 
            echo "id - ". $d->id. "<br>";
                echo "a - ". $d->a. "<br>";
                echo "b - ". $d->b. "<br>";
                echo "opr - ". $d->opr. "<br>";
                echo "created_at - ". $d->created_at. "<br><br>";
        }
        // create new record
        if($filter == 'createrecord'){
            echo "Create new record<br><br>";
            // Retrieve  id = 10 details
            $d = $calc::firstOrCreate(
                 [
                 'id' => '10'],
                ['a'=>'3'],['b'=>'3'],['opr'=>'add'],['created_at '=> '2023-07-04 6:00:00']
            ); 
            echo "id - ". $d->id. "<br>";
                echo "a - ". $d->a. "<br>";
                echo "b - ". $d->b. "<br>";
                echo "opr - ". $d->opr. "<br>";
                echo "created_at - ". $d->created_at. "<br><br>";
        }
        //this will return last record
        if($filter == 'last'){
            echo "Last record<br><br>";
            $d = $calc->orderby('id','desc')->first();

                echo "id - ". $d->id. "<br>";
                echo "a - ". $d->a. "<br>";
                echo "b - ". $d->b. "<br>";
                echo "opr - ". $d->opr. "<br>";
                echo "created_at - ". $d->created_at. "<br><br>";
        }
        //this will return top 3 records
        if($filter =='top3'){
            $data = $calc->limit(3)->get();
            echo "Top 3 records : " .$data->count()."<br><br>";
             foreach($data as $d){
                echo "id - " . $d->id. "  |  ";
                echo "a - " . $d->a. "  |  ";
                echo "b - " . $d->b. "  |  ";
                echo "opr - " . $d->opr. "  |  ";
                echo "created_at - " . $d->created_at. "<br><br>";
             }            
        }
        //this will return buttom 3 records
        if($filter =='buttom3'){
            $data = $calc->orderby('id','desc')->limit(3)->get();
            echo "Buttom 3 records : " .$data->count()."<br><br>";
            foreach($data as $d){
                echo "id - " . $d->id. "  |  ";
                echo "a - " . $d->a. "  |  ";
                echo "b - " . $d->b. "  |  ";
                echo "opr - " . $d->opr. "  |  ";
                echo "created_at - " . $d->created_at. "<br><br>";
             }            
        }
        //this will return records in reverse order
        if($filter =='reverse'){
           // $data = $calc->orderby('id','desc')->get();
            $data = $calc->orderbydesc('id')->get();
            echo "Reverse order records : " .$data->count()."<br><br>";
             foreach($data as $d){
                echo "id - " . $d->id. "  |  ";
                echo "a - " . $d->a. "  |  ";
                echo "b - " . $d->b. "  |  ";
                echo "opr - " . $d->opr. "  |  ";
                echo "created_at - " . $d->created_at. "<br><br>";
             }            
        }
        //aggregatefunctions
        if($filter =='sum'){
             $data = $calc->sum('a');
             echo "Filter : Column(".$filter.") value : (operation) ".$value." result : ".$data ; 
              }            
         
         //another approch
         if($filter =='a'){
            if($value=='sum')
             $data = $calc->sum('a');
             else if($value=='min')
             $data = $calc->min('a');
             else if($value=='max')
             $data = $calc->max('a');
             else if($value=='avg')
             $data = $calc->avg('a');
            
             echo "Filter : Column(".$filter.") value : (operation) ".$value." result : ".$data ;           
         }
         // retrive column data
         if($filter =='pluck'){
             $data = $calc->pluck($value);
             dd($data);
             echo "Reverse order records : " .$data->count()."<br><br>";
              foreach($data as $d){
                 echo "id - " . $d->id. "  |  ";
                 echo "a - " . $d->a. "  |  ";
                 echo "b - " . $d->b. "  |  ";
                 echo "opr - " . $d->opr. "  |  ";
                 echo "created_at - " . $d->created_at. "<br><br>";
              }            
         }
         //groupBy
         if($filter =='groupBy'){
            $data = $calc->get()->groupBy('opr');
           // dd($data);
                echo $data;
        }


    }

}