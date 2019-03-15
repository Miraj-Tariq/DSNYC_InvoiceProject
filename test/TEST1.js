var arr = [ ['54895','15','2'],
            ['14368','','0'],
            ['74952','6','1'],
            ['78135','10','0'],
            ['48765','','2'],
            ['74952','','0']];

arr.sort(function (a, b) {
    return Number(a[0]) - Number(b[0]);
});

console.log(arr);

var uniqueArr = [], keys = []; // Create an array for storing the key values
for (var i in arr) {
    if (keys.indexOf(arr[i][0]) === -1) {
        uniqueArr.push(arr[i]); // Push the value onto the unique array
        keys.push(arr[i][0]); // Push the key onto the 'key' array
    }
}
console.log(uniqueArr);


$(document).ready(function () {
    // var arr = [1,2,3,4,5,6,7,8,9,10];
    //
    // var res = $.inArray(11, arr);
    //
    // alert(res);
    var i = 1;

    while (true){
        setTimeout(function () {
            $('#tesID').val(i + 1);
        }, 1000);
    }



});