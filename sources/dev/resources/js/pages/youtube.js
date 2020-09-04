import API from '../api';

let Youtube = {
    getYoutubeApi: function(){
        let url = API.getYoutubeApi();
        API.requestApi(url,function(data){
            alert(data);
            console.log(data);
        },null,'post');
    }
}
$( document ).ready(function() {
    console.log( "ready!" );
    $('#demo-youtube').click( function(){
        Youtube.getYoutubeApi();
    })
});