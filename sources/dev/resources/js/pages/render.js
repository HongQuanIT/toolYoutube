import API from '../api';

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      
      reader.onload = function(e) {
        document.getElementById('blah').style.display = 'inline-block';
        $('#blah').attr('src', e.target.result);
      }
      
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}
let my_frame = {
  getListFrameApi: function(){
    let url = API.getFrameApi();
    API.requestApi(url,function(data){
        let html = data.map(item => `
          <option value="${item.id}">${item.name}</option>
        `)
        $("#chose_frame").append(html);
    });
  },
  getFrameDetailApi: function(id){
    let url = API.getFrameDetailApi(id);
    API.requestApi(url,function(data){
        console.log(data);
        $("#description_frame").html(my_frame.get_html_des());
        switch (id) {
          case 1:
            $("#_gethtmldes").append(my_frame.get_html_des_logo());
            $("#_gethtmldes").append(my_frame.get_html_des_logo_type());
            $("#_gethtmldes").append(my_frame.get_html_des_des(data.description));
            break;
          case 2:
            $("#_gethtmldes").append(my_frame.get_html_des_logo());
            $("#_gethtmldes").append(my_frame.get_html_des_des(data.description));
            break
          case 3:
            $("#_gethtmldes").append(my_frame.get_html_des_logo());
            $("#_gethtmldes").append(my_frame.get_html_des_logo_type());
            $("#_gethtmldes").append(my_frame.get_html_des_des(data.description));
            break;
        
          default:
            break;
        }
        $("#preview_frame").html(my_frame.get_html_preview(data.url_demo,data.name));
        $("#imgInp").change(function() {
          readURL(this);
        });
    });
  },
  get_html_des : function(){
    return `
    <div class="card h-100" style="margin-top:0">
      <div class="card-header">
      Mô tả
      </div>
      <ul id="_gethtmldes" class="">
      </ul>
  </div>
    `
  },
  get_html_des_logo : function(){
    return ` <li class="">
                <label class="" style="margin-right:20px">Logo</label>
                <input type='file' name="logo" id="imgInp" />
                <img id="blah" src="#" alt="your logo" style="width:60px;border: 1px solid #ddd;border-radius: 4px;padding: 3px;"/>
            </li>`
  },
  get_html_des_logo_type : function(){
    return `<li style="margin-top: 12px;">
                <label class="" style="margin-right:20px">Định dạng</label>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input" id="radio1" name="typevideo" value="1" checked>Mp4
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input" id="radio2" name="typevideo" value="2">Webm
                    </label>
                </div>
            </li>`
  },
  get_html_des_des : function(des){
    return `<li class="decription" style="margin-top: 12px;">
                <p>${des}</p>
            </li>`
  },
  get_html_preview : function(src,name){
    return `                    
    <div class="card h-100" style="margin-top:0">
        <div class="card-header">
            Xem trước ( demo )
        </div>

        <div class="" style="display: inherit;">
            <video style="border: 1px solid #ddd;border-radius: 4px;padding: 3px;margin-left: 20px;" class="" src="${src}" controls></video>
            <div style="padding-left: 12px">
                <h6>${name}</h6>
                <label class="" style="margin-right:10px">Author: </label><a href="https://www.facebook.com/HongQuan.ITC">Quân Đặng</a>
            </div>
        </div>
    </div>`;
  }
}
function ChooseFrame(frame){
  if (frame == 0) {
    $("#description_frame").html('');
    $("#preview_frame").html('');
    return;
  }
  my_frame.getFrameDetailApi(frame);
}
let myalert = {
   reset: function() {
    $("#toggleCSS").attr("href", "./alertify/alertify.default.css");
    alertify.set({
      labels : {
        ok     : "OK",
        cancel : "Cancel"
      },
      delay : 5000,
      buttonReverse : false,
      buttonFocus   : "ok"
    });
  }
}
$( document ).ready(function() {
    my_frame.getListFrameApi();
    $("#chose_frame").on('change', function(){
      let frame = Number($(this).val());
      ChooseFrame(frame);
    });
    $("#alert").on( 'click', function () {
        myalert.reset();
        alertify.alert("This is an alert dialog");
        return false;
    });
});
