var copyTextareaBtn = document.querySelector('.copy-btn#copy-province');

copyTextareaBtn.addEventListener('click', function(event) {
  var copyTextarea = document.querySelector('#field-province');
  copyTextarea.select();

  try {
    var successful = document.execCommand('copy');
    var msg = successful ? 'successful' : 'unsuccessful';
    console.log('Copying text command was ' + msg);
  } catch (err) {
    console.log('Oops, unable to copy');
  }
});