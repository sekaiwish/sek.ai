var cursorState = false;
const data = [
  [
    {label:'/home/ - login to sekai', fun:function() {modalToggle()}},
    {label:'/mhf/ - mhf information', url:'/mhf/'},
    {label:'/erupe/ - mhf server emulator', url:'https://github.com/ZeruLight/Erupe'},
    {label:'/stars/ - osrs shooting star tracker', url:'/stars/'},
    {label:'/iku/ - pomf-powered file hosting', url:'/iku/'},
    {label:'contact information', fun:function() {
      document.getElementById('data').style = 'opacity:0';
      setTimeout(function(){loadData(1)}, 1000);
    }}
  ],[
    {label:'discord', url:'//discord.com/users/119094696487288833'},
    {label:'gpg', url:'/k.asc'},
    {label:'email', url:'mailto:wish@sek.ai'},
    {label:'steam', url:'//steamcommunity.com/id/wishdere'},
    {label:'github', url:'//github.com/sekaiwish'},
    {label:'x', url:'//x.com/wishdere'},
    {label:'return', fun:function() {
      document.getElementById('data').style = 'opacity:0';
      setTimeout(function(){loadData(0)}, 1000);
    }}
  ]
];
function redraw() {
  draw(1, '#00a0a0');
}
function init_page() {
  document.getElementById('header').innerHTML = '_';
  setTimeout(function() {document.getElementById('header').innerHTML = 'w_'}, 180);
  setTimeout(function() {document.getElementById('header').innerHTML = 'wi_'}, 360);
  setTimeout(function() {document.getElementById('header').innerHTML = 'wis_'}, 540);
  setTimeout(function() {
    document.getElementById('header').innerHTML = "wish<span id='cursor'>_</span>";
    setInterval(blink, 530);
  }, 720);
}
function blink() {
  let elem = document.getElementById('cursor').style;
  cursorState
    ? (() => {elem.visibility = 'hidden'; cursorState = false})()
    : (() => {elem.visibility = 'visible'; cursorState = true})();
}
async function login(form) {
  const data = await postData('/php/login.php', {
    username: form.username.value,
    password: form.password.value
  });
  switch (data) {
    case 0:
      document.getElementById('mtitle').innerHTML = 'ユーザーが見つからない'; break;
    case 1:
      document.getElementById('mtitle').innerHTML = 'ログインに成功';
      window.location.href = '/home'; break;
    case 2:
      document.getElementById('mtitle').innerHTML = 'パスワードが間違'; break;
    default:
      document.getElementById('mtitle').innerHTML = 'ログインエラー';
  }
}
init_page();
init();
