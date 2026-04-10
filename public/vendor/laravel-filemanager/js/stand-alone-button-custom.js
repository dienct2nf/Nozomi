(function( $ ){

  $.fn.filemanager_button = function(type, options) {
    type = type || 'file';
    this.on('click', function(e) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = $('#' + $(this).data('input'));
        var target_preview = $('#' + $(this).data('preview'));
        window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
        //var file_path = items;
        // set the value of the desired input to image url
        // list item
        var listItems = target_input.val();
        if (listItems.length > -1) {
            var newArrayListItem = [];
            (listItems.split('|||')).forEach(function (item) {
                if($.trim(item) !== "") {
                    newArrayListItem.push(item)
                }
            });
            if(newArrayListItem.indexOf(items) == -1) {
              newArrayListItem.push(items);
            } else {
              alert('Trùng lặp\nHình ảnh đã tồn tại.');
            }
        }

          // clear previous preview
          // target_preview.attr("src",items).addClass('d-block');

          // set or change the preview image src
          if (Array.isArray(newArrayListItem)) {
              console.log(newArrayListItem)
              target_preview.empty();
              newArrayListItem.forEach(function (item) {
                var ids = Math.floor(Math.random() * 100);
                var html = '<div id="'+ids+'" class="album"><img src="'+item+'"><span data-url="'+item+'" data-id="'+ids+'" class="delete-thumb" title="xóa hình ảnh"><i class="fas fa-minus-circle"></i></span></div>';
              if($.trim(item) !== "") {
                  target_preview.append(html);
              }
              });

            var file_path = newArrayListItem.map(function (item) {
                if($.trim(item) !== "") {
                    return $.trim('/photos/'+(item).split('/photos/').pop());
                }
              }).join('|||');

            target_input.val('').val(file_path).trigger('change');

          } else {

            target_input.val('').val('/photos/'+(items).split('/photos/').pop()).trigger('change');

          }

          // trigger change event
        };
        return false;
      });
  }

})(jQuery);
