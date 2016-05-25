var login = {
    submitLogin: function(e,el) {
        e.preventDefault();
        $(el).ajaxSubmit({
            success: function() {
                location.reload();
            }
        });
    }
};