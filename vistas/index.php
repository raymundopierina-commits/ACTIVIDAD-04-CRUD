<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Progetto</title>
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
      font-family: Arial, sans-serif;
      background: #f3f4f6;
      display: flex;
      min-height: 100vh;
      font-size: 14px;
    }

    /* ── SIDEBAR ── */
    .sidebar {
      width: 200px;
      background: #1f2937;
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      height: 100vh;
      top: 0; left: 0;
    }
    .sidebar-brand {
      padding: 20px 16px;
      border-bottom: 1px solid #374151;
    }
    .sidebar-brand h1 { font-size: 15px; font-weight: bold; }
    .sidebar-brand span { font-size: 11px; color: #9ca3af; }

    .sidebar-label {
      padding: 16px 16px 6px;
      font-size: 10px;
      color: #6b7280;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .nav-item {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px 16px;
      color: #d1d5db;
      cursor: pointer;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      font-size: 13px;
      transition: background .15s;
    }
    .nav-item:hover  { background: #374151; color: #fff; }
    .nav-item.active { background: #3b82f6; color: #fff; }

    /* ── MAIN ── */
    .main { margin-left: 200px; flex: 1; display: flex; flex-direction: column; }

    .topbar {
      height: 52px;
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 24px;
      position: sticky;
      top: 0;
      z-index: 50;
    }
    .topbar-title { font-size: 14px; font-weight: 600; color: #111827; }
    .topbar-title span { color: #9ca3af; font-weight: 400; }

    .btn-add {
      background: #3b82f6;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 7px 14px;
      font-size: 13px;
      cursor: pointer;
    }
    .btn-add:hover { background: #2563eb; }

    .content { padding: 24px; }

    /* ── TABLE ── */
    .table-card {
      background: #fff;
      border: 1px solid #e5e7eb;
      border-radius: 8px;
      overflow: hidden;
    }
    .table-card-header {
      padding: 12px 18px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .table-card-header h2 { font-size: 13px; color: #374151; }
    .record-count {
      font-size: 11px;
      background: #f3f4f6;
      color: #6b7280;
      padding: 2px 8px;
      border-radius: 20px;
    }

    table { width: 100%; border-collapse: collapse; }
    thead th {
      text-align: left;
      padding: 10px 18px;
      font-size: 11px;
      color: #9ca3af;
      text-transform: uppercase;
      background: #f9fafb;
      border-bottom: 1px solid #e5e7eb;
    }
    tbody tr { border-bottom: 1px solid #f3f4f6; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f9fafb; }
    tbody td { padding: 11px 18px; color: #111827; }
    .td-id { color: #9ca3af; font-size: 12px; }
    .td-actions { display: flex; gap: 6px; }

    .btn-sm {
      padding: 4px 10px;
      font-size: 12px;
      border-radius: 4px;
      border: 1px solid #e5e7eb;
      background: #fff;
      color: #374151;
      cursor: pointer;
    }
    .btn-sm:hover { background: #f3f4f6; }
    .btn-sm-danger { color: #dc2626; border-color: #fecaca; background: #fef2f2; }
    .btn-sm-danger:hover { background: #fee2e2; }

    .estado-pill {
      font-size: 11px;
      padding: 2px 8px;
      border-radius: 20px;
      font-weight: 500;
    }
    .estado-1 { background: #dcfce7; color: #16a34a; }
    .estado-0 { background: #f3f4f6; color: #9ca3af; }

    .empty-row td { text-align: center; padding: 36px; color: #9ca3af; }

    /* ── MODAL ── */
    .overlay {
      display: none;
      position: fixed; inset: 0;
      background: rgba(0,0,0,.4);
      z-index: 200;
      align-items: center;
      justify-content: center;
    }
    .overlay.open { display: flex; }

    .modal {
      background: #fff;
      border-radius: 10px;
      width: 100%;
      max-width: 400px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,.15);
      animation: mi .18s ease;
    }
    @keyframes mi {
      from { opacity: 0; transform: translateY(-10px); }
      to   { opacity: 1; transform: translateY(0); }
    }

    .modal-header {
      padding: 16px 20px;
      border-bottom: 1px solid #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .modal-header h3 { font-size: 15px; font-weight: 600; }
    .modal-close {
      background: none; border: none; font-size: 20px;
      cursor: pointer; color: #9ca3af; line-height: 1;
    }
    .modal-close:hover { color: #111827; }

    .modal-body { padding: 20px; }

    .field { margin-bottom: 14px; }
    .field label { display: block; font-size: 12px; color: #6b7280; margin-bottom: 5px; font-weight: 500; }
    .field input, .field select {
      width: 100%;
      border: 1px solid #e5e7eb;
      border-radius: 6px;
      padding: 8px 11px;
      font-size: 13px;
      color: #111827;
    }
    .field input:focus, .field select:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,.1);
    }
    .hint { font-size: 11px; color: #9ca3af; margin-top: 4px; }

    .modal-footer {
      padding: 12px 20px;
      border-top: 1px solid #e5e7eb;
      display: flex;
      gap: 8px;
      justify-content: flex-end;
    }
    .btn-cancel {
      padding: 7px 14px; font-size: 13px;
      border: 1px solid #e5e7eb; background: #fff;
      border-radius: 6px; cursor: pointer; color: #374151;
    }
    .btn-cancel:hover { background: #f3f4f6; }
    .btn-save {
      padding: 7px 18px; font-size: 13px;
      background: #3b82f6; color: #fff;
      border: none; border-radius: 6px; cursor: pointer;
    }
    .btn-save:hover { background: #2563eb; }

    /* ── TOAST ── */
    #toast {
      position: fixed; bottom: 20px; right: 20px;
      background: #fff; border: 1px solid #e5e7eb;
      border-radius: 6px; padding: 10px 14px;
      font-size: 13px; display: flex; align-items: center; gap: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,.1);
      opacity: 0; transform: translateY(6px);
      transition: all .25s; pointer-events: none; z-index: 999;
    }
    #toast.show { opacity: 1; transform: translateY(0); }
    #toast.ok  { border-left: 3px solid #16a34a; }
    #toast.err { border-left: 3px solid #dc2626; }
    .toast-dot { width: 7px; height: 7px; border-radius: 50%; }
    .ok  .toast-dot { background: #16a34a; }
    .err .toast-dot { background: #dc2626; }
  </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
  <div class="sidebar-brand">
    <h1>TAREA PMI CRUD</h1>
    <span>CREATED BY NAIG</span>
  </div>
  <p class="sidebar-label">Módulos</p>
  <button class="nav-item active" onclick="setView('productos')">📦 Productos</button>
  <button class="nav-item" onclick="setView('usuarios')">👤 Usuarios</button>
</aside>

<!-- MAIN -->
<div class="main">
  <header class="topbar">
    <span class="topbar-title" id="topbar-title"><span>Módulos /</span> Productos</span>
    <button class="btn-add" onclick="abrirModalNuevo()">+ Agregar</button>
  </header>

  <div class="content">

    <!-- PRODUCTOS -->
    <div id="view-productos">
      <div class="table-card">
        <div class="table-card-header">
          <h2>Lista de Productos</h2>
          <span class="record-count" id="count-productos">0 registros</span>
        </div>
        <table>
          <thead><tr><th>#</th><th>Nombre</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead>
          <tbody id="tbody-productos"><tr class="empty-row"><td colspan="5">Cargando...</td></tr></tbody>
        </table>
      </div>
    </div>



<!-- MODAL PRODUCTO -->
<div class="overlay" id="modal-producto">
  <div class="modal">
    <div class="modal-header">
      <h3 id="mp-title">Nuevo Producto</h3>
      <button class="modal-close" onclick="cerrarModal('modal-producto')">×</button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="mp-id"/>
      <div class="field"><label>Nombre del producto</label><input type="text" id="mp-nombre"/></div>
      <div class="field"><label>Precio (S/)</label><input type="number" id="mp-precio" step="0.01" min="0"/></div>
      <div class="field"><label>Estado</label>
        <select id="mp-estado"><option value="1">Activo</option><option value="0">Inactivo</option></select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="cerrarModal('modal-producto')">Cancelar</button>
      <button class="btn-save" onclick="guardarProducto()">Guardar</button>
    </div>
  </div>
</div>

<!-- MODAL USUARIO -->
<div class="overlay" id="modal-usuario">
  <div class="modal">
    <div class="modal-header">
      <h3 id="mu-title">Nuevo Usuario</h3>
      <button class="modal-close" onclick="cerrarModal('modal-usuario')">×</button>
    </div>
    <div class="modal-body">
      <input type="hidden" id="mu-id"/>
      <div class="field"><label>Nombre de usuario</label><input type="text" id="mu-nombre"/></div>
      <div class="field"><label>Clave</label><input type="password" id="mu-clave"/><p class="hint" id="mu-hint"></p></div>
      <div class="field"><label>Estado</label>
        <select id="mu-estado"><option value="1">Activo</option><option value="0">Inactivo</option></select>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="cerrarModal('modal-usuario')">Cancelar</button>
      <button class="btn-save" onclick="guardarUsuario()">Guardar</button>
    </div>
  </div>
</div>

<div id="toast"><span class="toast-dot"></span><span id="toast-msg"></span></div>

<script>
  const CTRL_P = '../controladores/ProductoController.php';
  let vistaActual = 'productos';

  function setView(vista) {
    vistaActual = vista;
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    event.currentTarget.classList.add('active');
    document.getElementById('view-productos').style.display = vista === 'productos' ? '' : 'none';
    document.getElementById('view-usuarios').style.display  = vista === 'usuarios'  ? '' : 'none';
    document.getElementById('topbar-title').innerHTML = `<span>Módulos /</span> ${vista === 'productos' ? 'Productos' : 'Usuarios'}`;
    if (vista === 'productos') listarProductos();
    if (vista === 'usuarios')  listarUsuarios();
  }

  async function listarProductos() {
    const tbody = document.getElementById('tbody-productos');
    try {
      const data = await fetch(`${CTRL_P}?op=listar`).then(r => r.json());
      document.getElementById('count-productos').textContent = `${data.length} registros`;
      tbody.innerHTML = data.length ? data.map(p => `
        <tr>
          <td class="td-id">${p.id}</td>
          <td>${esc(p.nombre)}</td>
          <td>S/ ${parseFloat(p.precio).toFixed(2)}</td>
          <td><span class="estado-pill estado-${p.estado}">${p.estado == 1 ? 'Activo' : 'Inactivo'}</span></td>
          <td class="td-actions">
            <button class="btn-sm" onclick="editarProducto(${p.id})">Editar</button>
            <button class="btn-sm btn-sm-danger" onclick="eliminarProducto(${p.id})">Eliminar</button>
          </td>
        </tr>`).join('') : '<tr class="empty-row"><td colspan="5">Sin registros</td></tr>';
    } catch { tbody.innerHTML = '<tr class="empty-row"><td colspan="5" style="color:#dc2626">Error de conexión</td></tr>'; }
  }

  function abrirModalNuevo() {
    if (vistaActual === 'productos') {
      ['mp-id','mp-nombre','mp-precio'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('mp-estado').value = '1';
      document.getElementById('mp-title').textContent = 'Nuevo Producto';
      abrirModal('modal-producto');
    } else {
      ['mu-id','mu-nombre','mu-clave'].forEach(id => document.getElementById(id).value = '');
      document.getElementById('mu-estado').value = '1';
      document.getElementById('mu-title').textContent = 'Nuevo Usuario';
      document.getElementById('mu-hint').textContent = '';
      abrirModal('modal-usuario');
    }
  }

  async function editarProducto(id) {
    const p = await fetch(`${CTRL_P}?op=obtener&id=${id}`).then(r => r.json());
    if (p.error) { toast(p.error, false); return; }
    document.getElementById('mp-id').value     = p.id;
    document.getElementById('mp-nombre').value = p.nombre;
    document.getElementById('mp-precio').value = p.precio;
    document.getElementById('mp-estado').value = p.estado;
    document.getElementById('mp-title').textContent = 'Editar Producto';
    abrirModal('modal-producto');
  }

  async function guardarProducto() {
    const id = document.getElementById('mp-id').value;
    const nombre = document.getElementById('mp-nombre').value.trim();
    const precio = document.getElementById('mp-precio').value;
    const estado = document.getElementById('mp-estado').value;
    if (!nombre || !precio || parseFloat(precio) <= 0) { toast('Completa todos los campos', false); return; }
    const fd = new FormData();
    fd.append('nombre', nombre); fd.append('precio', precio); fd.append('estado', estado);
    const op = id ? 'actualizar' : 'guardar';
    if (id) fd.append('id', id);
    const data = await fetch(`${CTRL_P}?op=${op}`, { method: 'POST', body: fd }).then(r => r.json());
    toast(data.message, data.status);
    if (data.status) { cerrarModal('modal-producto'); listarProductos(); }
  }

  async function eliminarProducto(id) {
    if (!confirm('¿Eliminar este producto?')) return;
    const fd = new FormData(); fd.append('id', id);
    const data = await fetch(`${CTRL_P}?op=eliminar`, { method: 'POST', body: fd }).then(r => r.json());
    toast(data.message, data.status);
    if (data.status) listarProductos();
  }

  async function listarUsuarios() {
    const tbody = document.getElementById('tbody-usuarios');
    try {
      const data = await fetch(`${CTRL_U}?op=listar`).then(r => r.json());
      document.getElementById('count-usuarios').textContent = `${data.length} registros`;
      tbody.innerHTML = data.length ? data.map(u => `
        <tr>
          <td class="td-id">${u.id}</td>
          <td>${esc(u.nombre)}</td>
          <td style="color:#9ca3af;letter-spacing:.5px">••••••••</td>
          <td><span class="estado-pill estado-${u.estado}">${u.estado == 1 ? 'Activo' : 'Inactivo'}</span></td>
          <td class="td-actions">
            <button class="btn-sm" onclick="editarUsuario(${u.id})">Editar</button>
            <button class="btn-sm btn-sm-danger" onclick="eliminarUsuario(${u.id})">Eliminar</button>
          </td>
        </tr>`).join('') : '<tr class="empty-row"><td colspan="5">Sin registros</td></tr>';
    } catch { tbody.innerHTML = '<tr class="empty-row"><td colspan="5" style="color:#dc2626">Error de conexión</td></tr>'; }
  }

  async function editarUsuario(id) {
    const u = await fetch(`${CTRL_U}?op=obtener&id=${id}`).then(r => r.json());
    if (u.error) { toast(u.error, false); return; }
    document.getElementById('mu-id').value     = u.id;
    document.getElementById('mu-nombre').value = u.nombre;
    document.getElementById('mu-clave').value  = '';
    document.getElementById('mu-estado').value = u.estado;
    document.getElementById('mu-title').textContent = 'Editar Usuario';
    document.getElementById('mu-hint').textContent  = 'Deja la clave en blanco para no cambiarla';
    abrirModal('modal-usuario');
  }

  async function guardarUsuario() {
    const id = document.getElementById('mu-id').value;
    const nombre = document.getElementById('mu-nombre').value.trim();
    const clave  = document.getElementById('mu-clave').value.trim();
    const estado = document.getElementById('mu-estado').value;
    if (!nombre || (!id && !clave)) { toast('Completa todos los campos', false); return; }
    const fd = new FormData();
    fd.append('nombre', nombre); fd.append('clave', clave); fd.append('estado', estado);
    const op = id ? 'actualizar' : 'guardar';
    if (id) fd.append('id', id);
    const data = await fetch(`${CTRL_U}?op=${op}`, { method: 'POST', body: fd }).then(r => r.json());
    toast(data.message, data.status);
    if (data.status) { cerrarModal('modal-usuario'); listarUsuarios(); }
  }

  async function eliminarUsuario(id) {
    if (!confirm('¿Eliminar este usuario?')) return;
    const fd = new FormData(); fd.append('id', id);
    const data = await fetch(`${CTRL_U}?op=eliminar`, { method: 'POST', body: fd }).then(r => r.json());
    toast(data.message, data.status);
    if (data.status) listarUsuarios();
  }

  function abrirModal(id)  { document.getElementById(id).classList.add('open'); }
  function cerrarModal(id) { document.getElementById(id).classList.remove('open'); }
  document.querySelectorAll('.overlay').forEach(o => {
    o.addEventListener('click', e => { if (e.target === o) o.classList.remove('open'); });
  });

  function toast(msg, ok) {
    const t = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    t.className = 'show ' + (ok ? 'ok' : 'err');
    setTimeout(() => t.className = '', 3000);
  }

  function esc(str) {
    const d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
  }

  listarProductos();
</script>
</body>
</html>