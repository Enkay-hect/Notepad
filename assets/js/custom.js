$('.note-icon').click((event)=>{
    var clickedButton = event.currentTarget;
    var iconName = clickedButton.getAttribute('data-value');
    $('input[name=Icon]').val(iconName);
});