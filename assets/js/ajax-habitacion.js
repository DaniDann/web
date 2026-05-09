document.addEventListener('DOMContentLoaded', () => {
  const select = document.getElementById('producto_servicio_id');
  const info = document.getElementById('info-habitacion');

  async function cargarHabitacion() {
    const id = select.value;
    if (!id) {
      info.textContent = 'Selecciona una habitacion para ver precio y capacidad.';
      return;
    }
    try {
      const response = await fetch(`api/buscar_habitacion.php?id=${encodeURIComponent(id)}`);
      const data = await response.json();
      if (!response.ok) throw new Error(data.error || 'Error');
      info.textContent = `${data.nombre}: $${data.precio} MXN por noche, capacidad ${data.capacidad} huespedes. ${data.descripcion}`;
    } catch (error) {
      info.textContent = 'No se pudo cargar la informacion de la habitacion.';
    }
  }

  select.addEventListener('change', cargarHabitacion);
  cargarHabitacion();
});
