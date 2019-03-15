status = 0;
Required = "This field can't be empty";

var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};

var states = ['Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
];


$(document).ready(function(){
    alert(parseFloat("60"));
    $('#the-basics .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'states',
            source: substringMatcher(states)
        });
});


function validate(){
    if(document.getElementById("in1").value == ""){
        document.getElementById("in1Err").innerHTML = "Name field can't be empty";
        document.getElementById("in1Err").style.display = "";
        status = 1;
    }
    else{
        document.getElementById("in1Err").style.display = "none";
    }

    if(document.getElementById("in2").value == ""){
        document.getElementById("in2Err").innerHTML = "Address field can't be empty";
        document.getElementById("in2Err").style.display = "";
        status = 1;
    }
    else{
        document.getElementById("in2Err").style.display = "none";
    }

    if(status == 1){
        return false;
    }
    else{
        return true;
    }
}

function btnClickWOsubmit(){
    alert(document.getElementById('t').value);

    return false;
}