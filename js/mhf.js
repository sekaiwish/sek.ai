const data = [
  [
    {label:'where do i download mhf?', fun:function() {switchBox('dlMhf')}},
    {label:'how do i install mhf?', fun:function() {switchBox('mhfInstall')}},
    {label:'where do i download erupe?', fun:function() {switchBox('dlErupe')}},
    {label:'how do i install erupe?', fun:function() {switchBox('erupeInstall')}},
    {label:'is there a wiki?', fun:function() {switchBox('mhfFerias')}},
    {label:'how do i set up my controller?', fun:function() {switchBox('mhfController')}}
  ]
];
function redraw() {
  draw(0, "#150d26");
}
function switchBox(box) {
  switch (box) {
    case 'dlMhf':
      document.getElementById('mtitle').innerHTML = 'downloading mhf';
      document.getElementById('mbody').innerHTML = '<p>You can download the client through three different services.<br><ul>\
      <li><a href="https://drive.google.com/file/d/14WJcwhDAlr_8l_eZkarR6oKRHpQdi-Wy/view?usp=share_link">Google Drive</a></li>\
      <li><a href="https://mega.nz/file/GZohmSDR#65acEoCrXOhRi1yf8F1daEmMb5FVvLyW1Fgdn2mGSP4">MEGA</a></li>\
      <li><a href="https://nyaa.si/?q=monster+hunter+frontier">Nyaa Torrents</a></li>\
      </ul></p>';
      break;
    case 'mhfInstall':
      document.getElementById('mtitle').innerHTML = 'installing mhf';
      document.getElementById('mbody').innerHTML = '<p>First, <a onclick=switchBox("dlMhf")>download the client</a>.<br>\
      Second, follow this video tutorial.</p><video controls><source src="https://cdn.discordapp.com/attachments/927264741079019570/1069596663414538310/HowToInstallMHFZ.mp4" type="video/mp4"></video>';
      break;
    case 'dlErupe':
      document.getElementById('mtitle').innerHTML = 'downloading erupe';
      document.getElementById('mbody').innerHTML = '<p>You can download it directly <a href="https://cdn.discordapp.com/attachments/929509970624532511/1091692966545985667/Erupe-9.2.0-New.zip">here</a>.</p>';
      break;
    case 'erupeInstall':
      document.getElementById('mtitle').innerHTML = 'installing erupe';
      document.getElementById('mbody').innerHTML = '<p>First, <a onclick=switchBox("dlErupe")>download Erupe</a>.<br>\
      Second, follow this video tutorial.</p><video controls><source src="https://cdn.discordapp.com/attachments/927264741079019570/1105816842808860723/2023-05-10_17-43-23.mp4" type="video/mp4"></video>';
      break;
    case 'mhfFerias':
      document.getElementById('mtitle').innerHTML = 'visiting ferias';
      document.getElementById('mbody').innerHTML = '<p>You should see the site known as <a href="https://xl3lackout.github.io/MHFZ-Ferias-English-Project/">Ferias</a> for information and further game data.';
      break;
    case 'mhfController':
      document.getElementById('mtitle').innerHTML = 'controller troubleshooting';
      document.getElementById('mbody').innerHTML = '<p>You should read this <a href="https://pastebin.com/mTe3KWzf">Pastebin</a> for per-controller setup information.';
      break;
    default:
      document.getElementById('mtitle').innerHTML = 'error';
      document.getElementById('mbody').innerHTML = '<p>error loading content.</p>';
  }
}
document.getElementById('modal').style.visibility = 'visible';
document.getElementById('modal').style.opacity = 1;
init();