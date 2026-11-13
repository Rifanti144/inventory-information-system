(function () {
  'use strict';

  var body = document.body;

  /* ---------- Left bar ---------- */
  var toggle = document.getElementById('menu-toggle');
  var sidebar = document.getElementById('sidebar');
  var overlay = document.getElementById('sidebar-overlay');
  var main = document.getElementById('page-main');

  function setSidebar(open) {
    body.classList.toggle('sidebar-open', open);
    body.classList.toggle('no-scroll', open);
    sidebar.setAttribute('aria-hidden', open ? 'false' : 'true');
    toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    // Nothing outside the left bar can be focused or clicked while it is open.
    if (open) { main.setAttribute('inert', ''); } else { main.removeAttribute('inert'); }
  }

  if (toggle && sidebar && overlay) {
    toggle.addEventListener('click', function () {
      setSidebar(!body.classList.contains('sidebar-open'));
    });
    // The overlay covers the whole screen, so clicking anywhere outside
    // the bar (or on the hamburger icon beneath it) closes it.
    overlay.addEventListener('click', function () { setSidebar(false); });

    // Accordion: one group open at a time
    var groups = sidebar.querySelectorAll('.nav-group');
    groups.forEach(function (group) {
      var btn = group.querySelector('.nav-parent');
      btn.addEventListener('click', function () {
        var willOpen = !group.classList.contains('is-open');
        groups.forEach(function (g) {
          g.classList.remove('is-open');
          g.querySelector('.nav-parent').setAttribute('aria-expanded', 'false');
        });
        if (willOpen) {
          group.classList.add('is-open');
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  /* ---------- User dropdown ---------- */
  var userToggle = document.getElementById('user-toggle');
  var userDropdown = document.getElementById('user-dropdown');

  function setUserMenu(open) {
    userDropdown.hidden = !open;
    userToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  if (userToggle && userDropdown) {
    userToggle.addEventListener('click', function (e) {
      e.stopPropagation();
      setUserMenu(userDropdown.hidden);
    });
    document.addEventListener('click', function (e) {
      if (!userDropdown.hidden && !userDropdown.contains(e.target)) { setUserMenu(false); }
    });
  }

  document.addEventListener('keydown', function (e) {
    if (e.key !== 'Escape') { return; }
    if (userDropdown && !userDropdown.hidden) { setUserMenu(false); }
    if (body.classList.contains('sidebar-open')) { setSidebar(false); }
  });

  /* ---------- Delete confirmation ---------- */
  document.querySelectorAll('form[data-confirm]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      if (!window.confirm(form.getAttribute('data-confirm'))) { e.preventDefault(); }
    });
  });

  /* ---------- Select colour: muted placeholder, navy once chosen ---------- */
  document.querySelectorAll('.field select').forEach(function (select) {
    function paint() { select.classList.toggle('has-value', select.value !== ''); }
    select.addEventListener('change', paint);
    paint();
  });
})();
