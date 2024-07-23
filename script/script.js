function loadDataToModal(data) {
  document.getElementById('id').value = data.id;
  document.getElementById('nama').value = data.nama;
  document.getElementById('phone').value = data.telp;
  document.getElementById('participants').value = data.partisipan;
  document.getElementById('tanggal').value = data.tanggal;
  document.getElementById('durasi').value = data.durasi;
  document.getElementById('penginapan').checked = data.penginapan == 1 ? true : false;
  document.getElementById('transportasi').checked = data.transportasi == 1 ? true : false;
  document.getElementById('makanan').checked = data.makanan == 1 ? true : false;
  document.getElementById('tiketPrice').value = data.tiket;
  document.getElementById('subtotal').value = data.subtotal;
  document.getElementById('total').value = data.total;
}

$(document).ready(function() {
  const penginapanPrice = parseInt($('#penginapanPrice').text().replace(/\D/g, ''), 10);
  const transportasiPrice = parseInt($('#transportasiPrice').text().replace(/\D/g, ''), 10);
  const makananPrice = parseInt($('#makananPrice').text().replace(/\D/g, ''), 10);

  function hitungSubtotal() {
      const durasi = parseInt($('#durasi').val()) || 1;
      const tiketPrice = parseInt($('#tiketPrice').val()) || 0;

      let subtotal = 0;

      subtotal += tiketPrice * durasi;

      if ($('#penginapan').is(':checked')) {
          subtotal += penginapanPrice * durasi;
      }
      if ($('#transportasi').is(':checked')) {
          subtotal += transportasiPrice * durasi;
      }
      if ($('#makanan').is(':checked')) {
          subtotal += makananPrice * durasi;
      }

      $('#subtotal').val(`Rp. ${subtotal.toLocaleString('id-ID')}`);
  }

  function hitungTotal() {
      const participants = parseInt($('#participants').val()) || 1;
      const subtotal = parseInt($('#subtotal').val().replace(/\D/g, '')) || 0;

      const total = subtotal * participants;
      $('#total').val(`Rp. ${total.toLocaleString('id-ID')}`);
  }

  $('#hitung').on('click', function() {
      hitungSubtotal();
      hitungTotal();
      console.log(tiketPrice);
      console.log(penginapanPrice);
  });
});
