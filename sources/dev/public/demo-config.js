$(function(){
  /*
   * For the sake keeping the code clean and the examples simple this file
   * contains only the plugin configuration & callbacks.
   * 
   * UI functions ui_* can be located in: demo-ui.js
   */
  let user_id = $('body').attr('data-id');
  $('#drag-and-drop-zone').dmUploader({ //
    url: "backend/upload.php?id="+user_id,
    // maxFileSize: 3000000000, // 3 Megs 
    allowedTypes: '*',
    extFilter: ["mp4", "webm","avi","wmv"],
    onDragEnter: function(){
      // Happens when dragging something over the DnD area
      this.addClass('active');
    },
    onDragLeave: function(){
      // Happens when dragging something OUT of the DnD area
      this.removeClass('active');
    },
    onInit: function(){
      // Plugin is ready to use
      ui_add_log('Welcome to HQ Tool :)', 'info');
    },
    onComplete: function(){
      // All files in the queue are processed (success or error)
      ui_add_log('Tất cả video ở hàng đợi được tải lên thành công');
    },
    onNewFile: function(id, file){
      // When a new file is added using the file selector or the DnD area
      ui_add_log('Thêm một video #' + id);
      ui_multi_add_file(id, file);

      if (typeof FileReader !== "undefined"){
        var reader = new FileReader();
        var video = $('#uploaderFile' + id).find('video');
        
        reader.onload = function (e) {
          video.attr('src', e.target.result+'#t=2');
        }
        reader.readAsDataURL(file);
      }
    },
    onBeforeUpload: function(id){
      // about tho start uploading a file
      ui_add_log('Đang bắt đầu tải lên #' + id);
      ui_multi_update_file_progress(id, 0, '', true);
      ui_multi_update_file_status(id, 'uploading', 'Đang tải lên...');
    },
    onUploadProgress: function(id, percent){
      // Updating file progress
      ui_multi_update_file_progress(id, percent);
    },
    onUploadSuccess: function(id, data){
      // A file was successfully uploaded
      ui_add_log('Kết quả trả về từ server #' + id + ': ' + JSON.stringify(data));
      ui_add_log('Tải video lên #' + id + ' THÀNH CÔNG', 'success');
      ui_multi_update_file_status(id, 'success', 'Tải lên thành công');
      ui_multi_update_file_progress(id, 100, 'success', false);
    },
    onUploadError: function(id, xhr, status, message){
      ui_multi_update_file_status(id, 'danger', message);
      ui_multi_update_file_progress(id, 0, 'danger', false);  
    },
    onFallbackMode: function(){
      // When the browser doesn't support this plugin :(
      ui_add_log('Plugin cant be used here, running Fallback callback', 'danger');
    },
    onFileSizeError: function(file){
      ui_add_log('File \'' + file.name + '\' không thể thêm vào: Kích thước vượt quá giới hạn', 'danger');
    },
    onFileTypeError: function(file){
      ui_add_log('File \'' + file.name + '\' không thể thêm vào: Phải là định dạng video (type error)', 'danger');
    },
    onFileExtError: function(file){
      ui_add_log('File \'' + file.name + '\' không thể thêm vào: phải là một video (extension error)', 'danger');
    }
  });
});