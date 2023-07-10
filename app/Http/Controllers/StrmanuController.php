<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\strma;

class StrmanuController extends Controller
{
        /*
         * form method will show the form page from view
         */
        public function form(){
            return view('stringman.form');
               
        }
           /*
            * Result method will perform the operations
            * evaluate the result and then send the data to view.
            */
         
         public function result(){
           $str=request()->get('str');
           $opr=request()->get('opr');
           $result=null;
   
           if($opr=='strev')
           $result=strrev($str);
           if($opr=='stwc')
           $result=str_word_count($str);
           if($opr=='stlc')
           $result=strlen($str);
   
           $strm=new strma(); //create model object
           $strm->str = $str;
           $strm->opr = $opr;
           $strm->result = $result;
           $strm->save();
   
           return view('stringman.result')
           ->with('result',$result)
           ->with('str',$str)
           ->with('opr',$opr);
        }    
   
        public function logs(){
           $strm=new strma();
           //echo "logs";
          $data = $strm->all();
         //  dd($data);
           //echo "logs";
           return view('stringman.logs')->with('data' , $data);
        }
        public function queries(){
         // model object
         $strm=new strma(); 
       //$filter = all=>list all data
       //$filter = first=>display first record
       //$filter = last=>display last record
       //$filter = top,value=3 => display top 3 records
       //$filter = reverse =>display values in reverse order
       $filter = request()->get('filter');
       $value = request()->get('value');
       // to get all records with some conditions on where
         if($filter =='all'){
             $data = $strm->all();
             echo "All records : " .$data->count()."<br><br>";
 
              foreach($data as $d){
                 echo "id - " . $d->id. "  |  ";
                 echo "str - " . $d->str. "  |  ";
                 echo "opr - " . $d->opr. "  |  ";
                 echo "result - " . $d->result. "  |  ";
                 echo "created_at - " . $d->created_at. "<br><br>";
              }            
         }
         if($filter == 'first'){
            echo "First record<br><br>";
            
            $d = $strm->where('created_at','<=', '2023-07-03 03:57:21')
                         ->first();
             echo "id - " . $d->id. "  |  ";
             echo "str - " . $d->str. "  |  ";
             echo "opr - " . $d->opr. "  |  ";
             echo "result - " . $d->result. "  |  ";
             echo "created_at - " . $d->created_at. "<br><br>";
        }

       
        //this will return last record
        if($filter == 'last'){
            echo "Last record<br><br>";
            $d = $strm->orderby('id','desc')->first();

            echo "id - " . $d->id. "  |  ";
            echo "str - " . $d->str. "  |  ";
            echo "opr - " . $d->opr. "  |  ";
            echo "result - " . $d->result. "  |  ";
            echo "created_at - " . $d->created_at. "<br><br>";
        }
        //this will return top 3 records
        if($filter =='top3'){
            $data = $strm->limit(3)->get();
            echo "Top 3 records : " .$data->count()."<br><br>";
            foreach($data as $d){
               echo "id - " . $d->id. "  |  ";
               echo "str - " . $d->str. "  |  ";
               echo "opr - " . $d->opr. "  |  ";
               echo "result - " . $d->result. "  |  ";
               echo "created_at - " . $d->created_at. "<br><br>";
            }           
        }
        //this will return buttom 3 records
        if($filter =='buttom3'){
         $data = $strm->orderby('id','desc')->limit(3)->get();
         echo "Buttom 3 records : " .$data->count()."<br><br>";
         foreach($data as $d){
            echo "id - " . $d->id. "  |  ";
            echo "str - " . $d->str. "  |  ";
            echo "opr - " . $d->opr. "  |  ";
            echo "result - " . $d->result. "  |  ";
            echo "created_at - " . $d->created_at. "<br><br>";
         }           
     }
        //this will return records in reverse order
        if($filter =='reverse'){
           // $data = $calc->orderby('id','desc')->get();
            $data = $strm->orderbydesc('id')->get();
            echo "Reverse order records : " .$data->count()."<br><br>";
            foreach($data as $d){
               echo "id - " . $d->id. "  |  ";
               echo "str - " . $d->str. "  |  ";
               echo "opr - " . $d->opr. "  |  ";
               echo "result - " . $d->result. "  |  ";
               echo "created_at - " . $d->created_at. "<br><br>";
            }           
        }
      }
}
