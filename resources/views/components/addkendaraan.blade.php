<div class="col s12 card">
  <div class="row">
    <div class="col s12">
      <label>Tipe Kendaraan</label>
      <select name="kendaraan[]" class="browser-default">
        <option value="" disabled selected>Pilih Tipe Kendaraan</option>
        <option value="Sepeda Motor">Sepeda Motor</option>
        <option value="Mobil">Mobil</option>
        <option value="Bus">Bus</option>
        <option value="Truk Sedang">Truk Sedang</option>
        <option value="Truk Berat">Truk Berat</option>
        <option value="Lainnya">Lainnya</option>
      </select>
    </div>
    <div class="input-field col s4">
      <label for="merkid">Merk: </label>
        <input type="text" id="merkid" name="merk[]" value="">
    </div>
    <div class="input-field col s4">
      <label for="warnain">Warna: </label>
      <input type="text" id="warnain" name="warna[]" value="">
    </div>
    <div class="input-field col s4">
      <label for="platid">Plat:: </label>
      <input type="text" id="platid" name="plat[]" value="">
    </div>
  </div>
</div>
