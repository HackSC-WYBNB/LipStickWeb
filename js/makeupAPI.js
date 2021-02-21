/* To use this function,
<script src="./js/axios.0.021.1.min.js"></script>
<script src="./js/makeupAPI.js"></script>
*/

function callToMakeUpAPI(r,g,b,a,successFunction, failedFunction){
    axios.post('/apis/putMakeUpAPI.php',{
        'r': r,
        'g': g,
        'b': b,
        'a': a
    }).then(function (response){
        if(response.status !== 200){
            failedFunction(4,'Internal Server Error');
        }
        responseJSON = JSON.parse(response.data);
        if(responseJSON.errNo !== 0){
            failedFunction(responseJSON.errNo,responseJSON.description);
        }else{
            successFunction(responseJSON.data.original,responseJSON.data.after);
        }
    }).catch(function (error){
        failedFunctions(5,'Network Error');
    });
}