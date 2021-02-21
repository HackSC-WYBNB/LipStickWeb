/* To use this function,
<script src="./js/axios.0.021.1.min.js"></script>
<script src="./js/makeupAPI.js"></script>
*/

function callToMakeUpAPI(r,g,b,a,successFunction, failedFunction){
    r = parseInt(r);
    g = parseInt(g);
    b = parseInt(b);
    a = parseInt(a);
    let params = new URLSearchParams();
    params.append('r',r);
    params.append('g',g);
    params.append('b',b);
    params.append('a',a);
    axios.post('/apis/putMakeUpAPI.php',params).then(function (response){
        if(response.status !== 200){
            failedFunction(4,'Internal Server Error');
        }
        responseJSON = response.data
        if(responseJSON.errNo !== 0){
            failedFunction(responseJSON.errNo,responseJSON.description);
        }else{
            console.log(responseJSON.data.after);
            successFunction(responseJSON.data.original,responseJSON.data.after);
        }
    }).catch(function (error){
        console.log(error);
        failedFunction(5,'Network Error');
    });
}