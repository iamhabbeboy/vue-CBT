(function() {
  $(function() {
    $('.links-hover').hover(function() {
      var id;
      id = $(this).attr('id');
      return $('.btn-' + id).css('display', 'block');
    }, function() {
      var id;
      id = $(this).attr('id');
      return $('.btn-' + id).css('display', 'none');
    });
    return $('#search').click(function(e) {
      return $('#form_search').submit();
    });
  });
}).call(this);
