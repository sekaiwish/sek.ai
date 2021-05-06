const data = [
  [
    {label:'change account password', fun:function() {modalToggle()}},
    {label:'toggle trails globally', fun:function() {trailsToggle()}},
    {label:'/iku/ - pomf-powered file hosting', url:'/iku/'},
    {label:'/flac/ - lossless music collection', url:'/flac/'},
    {label:'/anime/ - unavailable', url:'/anime/'},
    {label:'/chan/ - unavailable', url:'/chan/'},
    {label:'/index/ - return to index', url:'/'}
  ]
];
function redraw() {
  draw(0, '#c06000');
}
async function password(form) {
  const data = await postData('/php/password.php', {
    old: form.old.value,
    new: form.new.value,
    confirm: form.confirm.value
  });
  switch (data) {
    case 0:
      document.getElementById('title').innerHTML = 'passwords don\'t match'; break;
    case 1:
      document.getElementById('title').innerHTML = 'user error'; break;
    case 2:
      document.getElementById('title').innerHTML = 'old password doesn\'t match'; break;
    case 3:
      document.getElementById('title').innerHTML = 'password changed'; break;
    default:
      document.getElementById('title').innerHTML = 'script error';
  }
}
async function logout() {
  const data = await postData('/php/logout.php', {});
  switch (data) {
    case 0:
      window.location.href = '/'; break;
    default:
      console.log('Error logging out');
  }
}
init();
