<html>

<style>
table{
border:solid;font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;}
  td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

th:hover
{background-color:yellow;}

tr
{color:#4d88ff;}
tr:hover{
	background-color:#ffff66;
	color:#4d88ff;cursor:pointer;
}

</style>
<body>

<div align="lefts">
<p>credits:   </p>
<p id="cred"></p>
<p>cal:   </p>
<p id="cal"></p>
<p>ccgpa:   </p>
<p id="cgpa"></p>
</div>

<div id="employees" style="display:block">
<table id="employ_table">
  <tr style="color:red">
    <th onclick="Sort(employ_tabledata,0,1)">name</th>
    <th onclick="Sort(employ_tabledata,1,0)">credits</th>
    <th onclick="Sort(employ_tabledata,2,0)">score</th>
  </tr>
<tbody id ="tabledata"></tbody>
</table>
</div>
<form class="modal-content animate" action="dsubmit.php" method="POST">
<table>
<tr>
<th>
  <input type="text" name="name" id="name" placeholder="name">
  </th> 
 <th>       
  <input type="number" name="credits" id="credits" placeholder="credits">
  </th>      
   <th>     
  <input type="number" name="score" id="score" placeholder="score">
  </th></tr>
   </table> 
   <br>    
          <div class="clearfix" align="center">
            <button type="submit" class="signup">Submit</button>
            <button type="reset" class="signup">Reset</button>
            
          </div>
        </div>
</form>

</body>
<script>
function cgpacalc(data)
{let num_rows = data.length;
let totalcredits=0;
let totalnum=0;

for(let i=0;i<num_rows;i++)
{
  totalcredits=totalcredits+Number(data[i][1]);
  let sco=Number(data[i][2])*Number(data[i][1]);
  totalnum=totalnum+sco;
}
document.getElementById("cred").innerHTML=totalcredits;
document.getElementById("cal").innerHTML=totalnum;
document.getElementById("cgpa").innerHTML=totalnum/totalcredits;

}


tablerequest("employees");
var employ_tabledata;
var col;
var ia;
var soco=-1;
function tablerequest(name)
{
var ajax = new XMLHttpRequest();
var method = "POST";
var url = 'data.php';
var asynchronous = true ;

ajax.open(method,url,asynchronous);

//ajax.setRequestHeader("content-type","appliction");
let tablename="name="+name;
ajax.send();

ajax.onreadystatechange = function()
{
	if(this.readyState == 4 && this.status == 200)
	{
  
    employ_tabledata = JSON.parse(this.responseText);
    
    writetotable(employ_tabledata);
    cgpacalc(employ_tabledata);
	}
}
}

function Sort(data,column,iora)
{
	col = column;
	ia  =iora;
  if(column==soco)
  {  data.reverse();
  writetotable(data);}
  else{
	let newdata = mergeSort(data);employ_tabledata=newdata;soco=column;writetotable(newdata);
  }
	
}

// Merge Sort Implentation (Recursion)
function mergeSort (unsortedArray) {
  // No need to sort the array if the array only has one element or empty
  if (unsortedArray.length <= 1) {
    return unsortedArray;
  }
  // In order to divide the array in half, we need to figure out the middle
  const middle = Math.floor(unsortedArray.length / 2);

  // This is where we will be dividing the array into left and right
  const left = unsortedArray.slice(0, middle);
  const right = unsortedArray.slice(middle);

  // Using recursion to combine the left and right
  return merge(
    mergeSort(left), mergeSort(right)
  );
}

// Merge the two arrays: left and right
function merge (left, right) {
  let resultArray = [], leftIndex = 0, rightIndex = 0;

  // We will concatenate values into the resultArray in order
  while (leftIndex < left.length && rightIndex < right.length) 
  {
  	if(ia==1){
    if (left[leftIndex][col] < right[rightIndex][col]) 
    {
      resultArray.push(left[leftIndex]);
      leftIndex++; // move left array cursor
    } 
    else
    {
      resultArray.push(right[rightIndex]);
      rightIndex++; // move right array cursor
    }
    }
    else
    {if (Number(left[leftIndex][col]) < Number(right[rightIndex][col])) 
    {
      resultArray.push(left[leftIndex]);
      leftIndex++; // move left array cursor
    } 
    else
    {
      resultArray.push(right[rightIndex]);
      rightIndex++; // move right array cursor
    }
    }
  }

  // We need to concat here because there will be one element remaining
  // from either left OR the right
  return resultArray.concat(left.slice(leftIndex)).concat(right.slice(rightIndex));
}
function writetotable(data)
{
	
		let num_columns = data[0].length;
		let num_rows = data.length;
		
		let html ="";
		for(let i= 0; i<num_rows;i++)
		{
	
			html += "<tr>";
			for(let j= 0; j<num_columns;j++)
			{
				
        if(j==2)
        {let a = Number(data[i][j]);
        if(a==10){html += "<td>" + "S" +"</td>";}
        else{
        let b=9-a;let c=String.fromCharCode(65+b);html += "<td>" + c +"</td>";}}
        else
        {
          let a = data[i][j];html += "<td>" + a +"</td>";
        }
			}
			html +="</tr>";
		}
		document.getElementById("tabledata").innerHTML = html;
}
</script>
</html>