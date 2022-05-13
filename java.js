function Sort(data,column,iora)
{
	 col = column;
	 ia  =iora;
	
	console.log(data.length);
	let newdata = mergeSort(data);
	console.log(newdata);
	writetotable(newdata);
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
		console.log(num_rows);
		let html ="";
		for(let i= 0; i<num_rows;i++)
		{
	
			html += "<tr>";
			for(let j= 0; j<num_columns;j++)
			{
				let a = data[i][j];html += "<td>" + a +"</td>";
			}
			html +="</tr>";
		}
		document.getElementById("tabledata").innerHTML = html;
}