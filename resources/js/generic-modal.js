$(function () {
    var genericModalEventHandler = function (event) {
        event.preventDefault();
        var $this = $(this);
        var $genericModal = $("#genericModal");
        var url = $this.data('url');
        var width = $this.data('modal-width');
        $genericModal.find('.modal-dialog').addClass(width);
        $genericModal.modal("toggle");
        $.ajax(url).done(function (data) {
            $genericModal.find('.modal-content').html(data);
        });
        return false;
    };

    $(".generic-modal").click(genericModalEventHandler);
});
