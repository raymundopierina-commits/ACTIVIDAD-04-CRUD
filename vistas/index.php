<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Productos</title>
    <style>
        body{font-family:Arial;background:#667eea;padding:20px}
        .container{max-width:1200px;margin:0 auto}
        .card{background:white;border-radius:10px;padding:20px;margin-bottom:20px}
        table{width:100%;border-collapse:collapse}
        th,td{padding:10px;text-align:left;border-bottom:1px solid #ddd}
        button{padding:8px 15px;margin:5px;cursor:pointer;border:none;border-radius:5px}
        .btn-add{background:#667eea;color:white}
        .btn-edit{background:#ffc107}
        .btn-delete{background:#dc3545;color:white}
        .modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);justify-content:center;align-items:center}
        .modal-content{background:white;padding:20px;border-radius:10px;width:400px}
        input,select{width:100%;padding:8px;margin:5px 0 15px;border:1px solid #ddd}
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h1>📦 Gestión de Productos</h1>
        <button class="btn-add" onclick="abrirModal()">➕ Nuevo Producto</button>
    </div>
    <div class="card">
        <table>
            <thead><tr><th>ID</th><th>Nombre</th><th>Precio</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody id="lista"></tbody>
        </table>
    </div>
</div>

<div id="modal" class="modal">
    <div class="modal-content">
        <h3 id="modalTitulo">Nuevo Producto</h3>
        <input type="hidden" id="id">
        <input type="text" id="nombre" placeholder="Nombre">
        <input type="number" id="precio" step="0.01" placeholder="Precio">
        <select id="estado"><option value="1">Activo</option><option value="0">Inactivo</option></select>
        <button onclick="guardar()">Guardar</button>
        <button onclick="cerrarModal()">Cancelar</button>
    </div>
</div>

<script>
    const API = '../controladores/ProductoController.php';
    
    async function listar() {
        const res = await fetch(`${API}?op=listar`);
        const data = await res.json();
        document.getElementById('lista').innerHTML = data.map(p => `
            <tr>
                <td>${p.id}</td>
                <td>${p.nombre}</td>
                <td>S/ ${parseFloat(p.precio).toFixed(2)}</td>
                <td>${p.estado == 1 ? ' Activo' : ' Inactivo'}</td>
                <td>
                    <button class="btn-edit" onclick="editar(${p.id})">✏️</button>
                    <button class="btn-delete" onclick="eliminar(${p.id})">🗑️</button>
                </td>
            </tr>
        `).join('');
    }
    
    async function guardar() {
        const id = document.getElementById('id').value;
        const formData = new FormData();
        formData.append('nombre', document.getElementById('nombre').value);
        formData.append('precio', document.getElementById('precio').value);
        formData.append('estado', document.getElementById('estado').value);
        if(id) formData.append('id', id);
        
        const op = id ? 'actualizar' : 'guardar';
        await fetch(`${API}?op=${op}`, {method: 'POST', body: formData});
        cerrarModal();
        listar();
    }
    
    async function editar(id) {
        const res = await fetch(`${API}?op=obtener&id=${id}`);
        const p = await res.json();
        document.getElementById('id').value = p.id;
        document.getElementById('nombre').value = p.nombre;
        document.getElementById('precio').value = p.precio;
        document.getElementById('estado').value = p.estado;
        document.getElementById('modalTitulo').innerText = 'Editar Producto';
        document.getElementById('modal').style.display = 'flex';
    }
    
    async function eliminar(id) {
        if(confirm('¿Eliminar producto?')) {
            const formData = new FormData();
            formData.append('id', id);
            await fetch(`${API}?op=eliminar`, {method: 'POST', body: formData});
            listar();
        }
    }
    
    function abrirModal() {
        document.getElementById('id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('estado').value = '1';
        document.getElementById('modalTitulo').innerText = 'Nuevo Producto';
        document.getElementById('modal').style.display = 'flex';
    }
    
    function cerrarModal() {
        document.getElementById('modal').style.display = 'none';
    }
    
    listar();
</script>
</body>
</html>