document.addEventListener('DOMContentLoaded', function () {
  var roomCatalog = {
    '': { name: 'Sin seleccionar', price: 0, capacity: 0 },
    'tzintzunzan': { name: 'Tzintzunzan', price: 1450, capacity: 2 },
    'paracho': { name: 'Paracho', price: 1500, capacity: 2 },
    'yunuen': { name: 'Yunuén', price: 1620, capacity: 3 },
    'patzcuaro': { name: 'Pátzcuaro', price: 1750, capacity: 3 },
    'coeneo': { name: 'Coeneo', price: 1480, capacity: 2 },
    'janitzio': { name: 'Janitzio', price: 1880, capacity: 2 },
    'suite-quencio': { name: 'Suite Quencio', price: 2400, capacity: 4 },
    'morelia': { name: 'Morelia', price: 1990, capacity: 3 },
    'tacambaro': { name: 'Tacámbaro', price: 1680, capacity: 2 },
    'uruapan': { name: 'Uruapan', price: 1850, capacity: 4 },
    'tlalpujagua': { name: 'Tlalpujahua', price: 1710, capacity: 2 },
    'cuitzeo': { name: 'Cuitzeo', price: 1580, capacity: 2 },
    'cuanajo': { name: 'Cuanajo', price: 1540, capacity: 2 }
  };

  var app = Vue.createApp({
    data: function () {
      return {
        roomCatalog: roomCatalog,
        habitacion: '',
        checkin: '',
        checkout: '',
        huespedes: 2,
        tipoCama: '',
        comentarios: ''
      };
    },
    computed: {
      selectedRoom: function () {
        return this.roomCatalog[this.habitacion] || this.roomCatalog[''];
      },
      nights: function () {
        if (!this.checkin || !this.checkout) {
          return 0;
        }
        var start = new Date(this.checkin + 'T00:00:00');
        var end = new Date(this.checkout + 'T00:00:00');
        var diff = end.getTime() - start.getTime();
        var days = Math.round(diff / 86400000);
        return days > 0 ? days : 0;
      },
      subtotal: function () {
        return this.selectedRoom.price * this.nights;
      },
      taxes: function () {
        return this.subtotal * 0.16;
      },
      total: function () {
        return this.subtotal + this.taxes;
      },
      validationMessage: function () {
        if (!this.habitacion) {
          return 'Selecciona una habitación para ver el cálculo.';
        }
        if (!this.checkin || !this.checkout) {
          return 'Agrega fecha de entrada y salida.';
        }
        if (this.nights === 0) {
          return 'La fecha de salida debe ser posterior al check-in.';
        }
        if (Number(this.huespedes) > this.selectedRoom.capacity) {
          return 'La habitación elegida admite hasta ' + this.selectedRoom.capacity + ' huésped(es).';
        }
        return 'Resumen actualizado correctamente.';
      },
      recommendation: function () {
        if (!this.habitacion) {
          return 'Puedes usar esta vista para validar precios antes de enviar la solicitud.';
        }
        if (Number(this.huespedes) > this.selectedRoom.capacity) {
          return 'Conviene cambiar a una habitación con mayor capacidad o reducir huéspedes.';
        }
        if (this.nights > 0) {
          return 'La tarifa estimada incluye impuestos y ' + this.nights + ' noche(s) de estancia.';
        }
        return 'Completa las fechas para obtener el total estimado.';
      }
    },
    methods: {
      money: function (value) {
        return new Intl.NumberFormat('es-MX', {
          style: 'currency',
          currency: 'MXN'
        }).format(value || 0);
      },
      syncFromForm: function () {
        var byId = function (id) {
          return document.getElementById(id);
        };
        this.habitacion = byId('habitacion').value;
        this.checkin = byId('checkin').value;
        this.checkout = byId('checkout').value;
        this.huespedes = byId('huespedes').value || 0;
        this.tipoCama = byId('tipo-cama').value;
        this.comentarios = byId('comentarios').value.trim();
      },
      resetSummary: function () {
        this.habitacion = '';
        this.checkin = '';
        this.checkout = '';
        this.huespedes = 2;
        this.tipoCama = '';
        this.comentarios = '';
      }
    },
    mounted: function () {
      var form = document.getElementById('booking-form-main');
      var fields = form.querySelectorAll('input, select');
      var self = this;

      fields.forEach(function (field) {
        field.addEventListener('input', function () {
          self.syncFromForm();
        });
        field.addEventListener('change', function () {
          self.syncFromForm();
        });
      });

      form.addEventListener('reset', function () {
        window.setTimeout(function () {
          self.resetSummary();
        }, 0);
      });

      form.addEventListener('submit', function (event) {
        self.syncFromForm();
        if (!form.checkValidity() || self.nights === 0 || Number(self.huespedes) > self.selectedRoom.capacity) {
          event.preventDefault();
        }
      });

      this.syncFromForm();
    },
    template: `
      <div>
        <h2>Resumen inteligente con Vue</h2>
        <p class="summary-status">{{ validationMessage }}</p>
        <div class="summary-grid">
          <div class="summary-card-box">
            <h3>Habitación</h3>
            <p>{{ selectedRoom.name }}</p>
          </div>
          <div class="summary-card-box">
            <h3>Capacidad</h3>
            <p>{{ selectedRoom.capacity || '-' }} huésped(es)</p>
          </div>
          <div class="summary-card-box">
            <h3>Noches</h3>
            <p>{{ nights }}</p>
          </div>
          <div class="summary-card-box">
            <h3>Tipo de cama</h3>
            <p>{{ tipoCama || 'Pendiente' }}</p>
          </div>
        </div>
        <div class="cost-summary cost-summary-vue">
          <div class="cost-item">
            <span>Tarifa por noche:</span>
            <span>{{ money(selectedRoom.price) }}</span>
          </div>
          <div class="cost-item">
            <span>Subtotal:</span>
            <span>{{ money(subtotal) }}</span>
          </div>
          <div class="cost-item">
            <span>Impuestos:</span>
            <span>{{ money(taxes) }}</span>
          </div>
          <div class="cost-item total">
            <span>Total estimado:</span>
            <span>{{ money(total) }}</span>
          </div>
        </div>
        <p class="summary-note">{{ recommendation }}</p>
        <p class="summary-note" v-if="comentarios">Comentario registrado: {{ comentarios }}</p>
      </div>
    `
  });

  app.mount('#vue-resumen');
});
