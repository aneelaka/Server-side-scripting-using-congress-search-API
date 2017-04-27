<html>
<head>
    <?php header('Content-type: text/html; charset=utf-8');
    header('Acess-Control-Allow-Origins: *');
    ?>
    <style>
    h4
        {
            text-align: center;
        }
        .box
        {
         border: 1px solid grey;
            width: 20%;
            height: 200px;
            margin: auto;
            text-align: center;
        }
        #boxed
        {
         border: 1px solid grey;
            width: 60%;
            height: 250px;
            margin: auto;
            display: none;
            text-align: center;
            padding-top: 2%;
            
            align-content: center;
            
                
                        
        }
        #table
        {
            
            margin: auto;
            align-self: center;
        }
        #text
        {
            margin-left: 20%;
            margin-top: 5%;
            
        }
        .table1
        {
            margin-left: auto;
            margin-right: auto;
             border-collapse: collapse;
            width: 1200;
                 
            
        }
      .table1 td 
        {
            width: 200;
        }
        #l_table
        {
            
           width: 50%;
  
  overflow: auto;
  margin: auto;
  position: absolute;
  top:550; left: 400; bottom: 0; right: 0;
     
            
            
        }
        #leg
        {
            border: 1px solid grey;
            width: 50%;
            height: 440px;
            margin: auto;
            display: none;
            text-align: center;
            padding-top: 2%;
            
            align-content: center;
        }
        #b_table
        {
          width: 50%;
  
  overflow: auto;
  margin: auto;
  position: absolute;
  top:300; left: 190; bottom: 0; right: 0;  
        }
        #zero_result
        {
         text-align: center;   
        }
        
    </style>
    </head>
    <body>
        <script>

            function change()
            {
                var opt=document.getElementById('cd').value;
                if(opt=="Legislators")
                    {
                       document.getElementById('Keyword').textContent="State/Representatives"; 
                    }
               else if(opt=="Committees")
                    {
                     document.getElementById('Keyword').textContent="Committee ID";   
                    }
                else if(opt=="Bills")
                    {
                      document.getElementById('Keyword').textContent="Bill ID";  
                    }
                else if(opt=="Amendments")
                    {
                      document.getElementById('Keyword').textContent="Amendment ID";
                    }
            }
        </script>
      <form action=""  method="post" id=myForm>
        <div class="box">
            
    <h4>
        Congress Information Search
        </h4>
            Congress Database <select id="cd"; name="cd"; selected="Select your option" onchange="change();">
            <option>Select your option </option>
            <option value="Legislators" <?php if(isset($_POST['cd']) && $_POST['cd']=='Legislators') {echo 'selected="selected"'; } ?>>Legislators</option>
            <option value="Committees" <?php if(isset($_POST['cd'])&& $_POST['cd']=='Committees') {echo 'selected="selected"'; } ?>>Committees</option>
            <option value="Bills" <?php if(isset($_POST['cd']) && $_POST['cd']=='Bills') {echo 'selected="selected"'; } ?>>Bills</option>
            <option value="Amendments" <?php if(isset($_POST['cd']) && $_POST['cd']=='Amendments') {echo 'selected="selected"'; } ?>>Amendments</option>
            </select>
            <br>
            Chamber
            <input type="radio" name="radio" value="senate" checked="senate" <?php if(@$_POST['radio'] == "senate") { echo "checked=\"checked\""; } ?> >Senate
<input type="radio" name="radio" value="house" <?php if(@$_POST['radio'] == "house") { echo "checked=\"checked\""; } ?> >House<br>
            <span id="Keyword"; value="Keyword"> Keyword*
            </span>
            <input type="text";id="text"; name="text" value="<?php echo @$_POST['text']; ?>" >
            <br>
            <input type="submit" name="submit" value="Search">
            <input type="button";value="clear";id="clear";onclick="clear();">
            <br>
            <br>
            <a href="http://sunlightfoundation.com/">Powered By Sunlight Foundation</a>
        </div>
         
        </form>
        <script>
        function clear()
            {
                
                document.getElementById("text").value="";
            }
        </script>
        <div id="table">
            
        <?php
if (isset($_POST['submit'])) 
{
    
if(isset($_POST['radio']))
{
//echo $_POST['radio'];  //  Displaying Selected Value

        

           $radio=$_POST['radio'];
}
           $text = $_POST['text'];
         $cd = $_POST['cd'];
    $error="";
    if($text=="" && $cd=="Select your option")
    {
        $error="Keyword,Congress Database";
        echo "<script>alert(\"Please enter the missing fields: $error \")</script>"; 
    }
    else
    if($cd=="Select your option" && $text!=null)
    {
        $error.="congress Database";
        echo "<script>alert(\"Please enter the missing fields: $error \")</script>"; 
    }
    else if($cd!="Select your option" && $text==null){
        $eror="Keyword";
        echo "<script>alert(\"Please enter the missing fields:Keyword \")</script>"; 
    }
    else
    {
    
    
    
        //echo $text." ".$cd." ".$radio;

    $url="http://congress.api.sunlightfoundation.com/";
        if($cd=="Committees")
        {
            $url.="committees?committee_id=".$text."&chamber=".$radio."&apikey=3bc3bcf9451949adb6ca3b1626bda00f"; 
                //https://congress.api.sunlightfoundation.com/committees?committee_id=COMMITTEE_ID_HERE& chamber=CHAMBER_TYPE_HERE&apikey=YOUR_API_KEY_HERE
        }
    else if($cd=="Legislators")
    {
         $states = array(
'Alabama'=>'AL',
'Alaska'=>'AK',
'Arizona'=>'AZ',
'Arkansas'=>'AR',
'California'=>'CA',
'Colorado'=>'CO',
'Connecticut'=>'CT',
'Delaware'=>'DE',
'District Of Columbia'=>'DC',
'Florida'=>'FL',
'Georgia'=>'GA',
'Hawaii'=>'HI',
'Idaho'=>'ID',
'Illinois'=>'IL',
'Indiana'=>'IN',
'Iowa'=>'IA',
'Kansas'=>'KS',
'Kentucky'=>'KY',
'Louisiana'=>'LA',
'Maine'=>'ME',
'Maryland'=>'MD',
'Massachusetts'=>'MA',
'Michigan'=>'MI',
'Minnesota'=>'MN',
'Mississippi'=>'MS',
'Missouri'=>'MO',
'Montana'=>'MT',
'Nebraska'=>'NE',
'Nevada'=>'NV',
'New Hampshire'=>'NH',
'New Jersey'=>'NJ',
'New Mexico'=>'NM',
'New York'=>'NY',
'North Carolina'=>'NC',
'North Dakota'=>'ND',
'Ohio'=>'OH',
'Oklahoma'=>'OK',
'Oregon'=>'OR',
'Pennsylvania'=>'PA',
'Rhode Island'=>'RI',
'South Carolina'=>'SC',
'South Dakota'=>'SD',
'Tennessee'=>'TN',
'Texas'=>'TX',
'Utah'=>'UT',
'Vermont'=>'VT',
'Virginia'=>'VA',
'Washington'=>'WA',
'West Virginia'=>'WV',
'Wisconsin'=>'WI',
'Wyoming'=>'WY'
);
        $text=strtolower($text);
        $text=ucwords($text);
        $flag="0";
        foreach ($states as $s => $abbr) 
        {
         if($text==$s)
         {
             $st=$abbr;
             $flag="1";
             
         }
        }
            
        
        
        
        if($flag=="1")
        {
        //echo $st;
        $url.="legislators?&chamber=".$radio."&state=".$st."&apikey=3bc3bcf9451949adb6ca3b1626bda00f"; 
            
        }
        else
        {
            $n=explode(" ",$text);
            $len=count($n);
            
            if ($len=="2")
            {  
                
            $url.="legislators?&chamber=".$radio."&first_name=".$n[0]."&last_name=".$n[1]."&apikey=3bc3bcf9451949adb6ca3b1626bda00f"; 
            }
            else
            {
                $url.="legislators?&chamber=".$radio."&query=".$text."&apikey=3bc3bcf9451949adb6ca3b1626bda00f";
            }
        }
       
    }
        
    else if($cd=="Bills")
    {
        $url.="bills?bill_id=".$text."&chamber=".$radio."&apikey=3bc3bcf9451949adb6ca3b1626bda00f"; 
            
            //https://congress.api.sunlightfoundation.com/bills?bill_id=BILL_ID_HERE&chamber=CHAMBER _TYPE_HERE&apikey=YOUR_API_KEY_HERE 
    } 
    else if($cd=="Amendments")
    {
        $url.="amendments?amendment_id=".$text."&chamber=".$radio."&apikey=3bc3bcf9451949adb6ca3b1626bda00f"; 
        
        
        //https://congress.api.sunlightfoundation.com/amendments?amendment_id=AMENDMENT_ID_HERE& chamber=CHAMBER_TYPE_HERE&apikey=YOUR_API_KEY_HERE
    }
   //echo $url;
    $json = file_get_contents($url);
    $obj = json_decode($json,true);
        
     //print_r($obj);
    //ini_set("allow_url_fopen", 1);
    echo "<table border= 1px solid black class=\"table1\" ;>";
    echo "<tr>";
    if($cd=="Bills"){
        if($obj['count']>0)
        {
    echo "<th align=center>Bill id</th>";
    echo "<th align=center>Short Title</th>";
    echo "<th align=center>Chamber</th>";
    echo "<th>Details</th></tr>";
    foreach($obj['results'] as $b)
    {
    echo "<tr>";
    echo "<td align=center>".$b['bill_id']."</td>";
    echo "<td align=center>".$b['short_title']."</td>";
    echo "<td align=center>".$b['chamber']."</td>";
        $bill_id=$b['bill_id'];
        $short_title=$b['short_title'];
        $sponsor=$b['sponsor']['title']." ".$b['sponsor']['first_name']." ".$b['sponsor']['last_name'];
        $introduced_on=$b['introduced_on'];
        $lawd=$b['last_version']['version_name'].", ".$b['last_action_at'];
        $bill_url=$b['last_version']['urls']['pdf'];
   echo "<td align=center> <a href='#' onclick=\"view_details_bills('$bill_id','$short_title','$sponsor','$introduced_on','$lawd','$bill_url')\"> View Details </a> </td>";
     
    
    echo "</tr>";
    }
    echo "</table>";
        }
        else
        {
            echo "<p id='zero_result'>The API returned zero results for the request";
        }
       
            
        }
else if($cd=="Amendments"){
   
 if($obj['count']>0)
        {
    echo "<th align=center>Amendment id</th>";
    echo "<th align=center>Amendment Type</th>";
    echo "<th align=center>Chamber</th>";
    echo "<th align=center>Introduced on</th></tr>";
    foreach($obj['results'] as $a)
    {
    echo "<tr>";
    echo "<td align=center>".$a['amendment_id']."</td>";
    echo "<td align=center>".$a['amendment_type']."</td>";
     echo "<td align=center>".$a['chamber']."</td>";
    echo "<td align=center>".$a['introduced_on']."</td>";
         
    echo "</tr>";
    }
    echo "</table>";
}
    else
    {
       echo "<p id='zero_result'>The API returned zero results for the request"; 
    }
} 
    else if($cd=="Committees")
    {
        if($obj['count']>0)
        {
        echo "<th align=center>Committee ID</th>";
        echo "<th align=center>Committee Name</th>";
        echo "<th align=center>Chamber</th></tr>";
       foreach($obj['results'] as $c)
         {  
            echo "<tr>";
            echo "<td align=center>".$c['committee_id']."</td>";
            echo "<td align=center>".$c['name']."</td>";
            echo "<td align=center>".$c['chamber']."</td>";
            
            echo "</tr>";
          }
       echo "</table>";
}
        else
        {
         echo "<p id=zero_result>The API returned zero results for the request";    
        }
    }
    else if($cd=="Legislators")
    {
        if($obj['count']>0)
        {
        echo "<th align=center>Name</th>";
        echo "<th align=center>State</th>";
        echo "<th align=center>Chamber</th>";
         echo "<th align=center>Details</th>";
        foreach($obj['results'] as $res)
        {
            
           $bid=$res['bioguide_id'];
            $office=$res['office'];
            $full_name=$res['title']." ".$res['first_name']." ".$res['last_name'];
            $s_name=$res['first_name']." ".$res['last_name'];
            $term_end=$res['term_end'];
            $website=$res['website'];
            $facebook_id=@$res['facebook_id'];
            $twitter_id=@$res['twitter_id'];
            //echo $office;
           
            //echo $bid;
            echo "<tr>";
            echo "<td align=center>".$res['first_name']." ".$res['last_name']."</td>";
            echo "<td align=center>".$res['state_name']."</td>";
            echo "<td align=center>".$res['chamber']."</td>";
             echo "<td align=center> <a href='#' onclick=\"view_details_legislators('$office','$bid','$full_name','$term_end','$website','$facebook_id','$twitter_id','$s_name')\"> View Details </a> </td>";
            echo "</tr>";
   
        }
         echo "</table>";
    }
        else
        {
           echo "<p id='zero_result'>The API returned zero results for the request";    
        }
       
            
            
    }
        
        
        }
}
        
        
        ?>
        </div>
    
        
        <div id="boxed">
        <script>
            function view_details_bills(bill_id,short_title,sponsor,introduced_on,lawd,bill_url)
            { 
                if(document.getElementById("boxed").style.display='none')
                    {
                        document.getElementById("boxed").style.display='block';
                    }
                
                document.getElementById("table").style.display="none";
               document.getElementById("boxed").innerHTML = "<p id=text><table id=b_table><tr><td>Bill id</td><td>"+bill_id+"</td></tr><br>"+"<tr><td>Bill Title</td><td>   "+short_title+"</td></tr><br>"+"<tr><td>Sponsor</td><td>   "+sponsor+"</td></tr><br>"+"<tr><td>Introduced On</td><td>   "+introduced_on+"</td></tr><br>"+"<tr><td>Last action with date</td><td>   "+lawd+"</td></tr><br>"+"<tr><td>Bill URL</td><td>"+"<a href=\""+bill_url+"\">"+short_title+"</a></td></tr></table>"; 
                
            }
            
           </script>
        </div>
            <div id="leg">
            <script>
            function view_details_legislators(bid,office,name,term_end,website,facebook_id,twitter_id,s_name)
            {
                if(document.getElementById("leg").style.display='none')
                    {
                        document.getElementById("leg").style.display='block';
                    }
               document.getElementById("table").style.display="none";
             
                var s_name=s_name;
                var temp=bid;
              var off=office;
                var img="https://theunitedstates.io/images/congress/225x275/"+off+".jpg";
               var name=name;
                var term_end=term_end;
                var website=website;
                if(facebook_id!=null)
               var facebook_id="https://www.facebook.com/"+facebook_id;
                else facebook_id=" ";
               var twitter_id="https://www.twitter.com/"+twitter_id; document.getElementById("leg").innerHTML="<img src=\""+img+"\">"+"<br>"+"<table id=l_table><tr><td>Full name </td><td>"+name+"</td></tr><br>"+"<tr><td>Term ends on</td><td>"+term_end+"</td></tr><br>"+"<tr><td>Website</td><td> "+"<a href=\""+website+"\">"+website+"</a>"+"</td></tr><br>"+"<tr><td>Office</td><td>"+temp+"</td></tr><br>"+"<tr><td>Facebook</td><td> "+"<a href=\""+facebook_id+"\">"+s_name+"</a>"+"</td></tr><br>"+"<tr><td>Twitter</td><td> "+"<a href=\""+twitter_id+"\">"+s_name+"</a>"+"</td></tr></table><br>";
                
                //https://congress.api.sunlightfoundation.com/legislators?chamber=house&state=WA&bioguid e_id=N000189&apikey=YOUR_API_KEY_HERE 
                //document.getElementById("table").style.display="none";
                //document.getElementById("boxed").innerHTML=x_y;
            }

            </script>
               </div>
    </body>
    
</html>