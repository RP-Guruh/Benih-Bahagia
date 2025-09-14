@extends('app') 
@section('content')
<div class="card bg-white border-0 rounded-3 mb-4">
  <div class="card-body p-4">

    <!-- Step 1 -->
    <div class="step active" id="step1">
      <div class="d-flex align-items-center mb-3">
        <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3">1</span>
        <h4 class="fs-18 fw-semibold mb-0">Data Siswa</h4>
      </div>
      <form id="formStep1">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group mb-4">
              <label class="label">Nama Siswa *</label>
              <input type="text" class="form-control" name="nama_siswa" required value="{{ $hasil->nama_siswa }}" />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-4">
              <label class="label">Nama Orang Tua (Opsional)</label>
              <input type="text" class="form-control" name="nama_orangtua" value="{{ $hasil->nama_orangtua }}" />
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label class="label">Tanggal Lahir *</label>
                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required value="{{ $hasil->tanggal_lahir }}" />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label class="label">Apakah anak dilahirkan dalam keadaan prematur *</label>
                <select class="form-select form-control" name="prematur" required>
                  <option value="" disabled>-- Pilih --</option>
                  <option value="y" {{ $hasil->prematur_info==='YA'?'selected':'' }}>Ya</option>
                  <option value="n" {{ $hasil->prematur_info==='TIDAK'?'selected':'' }}>Tidak</option>
                </select>
              </div>
            </div>
          </div>

          <div class="col-lg-6" id="usiaPrematurWrapper" style="display: none">
            <div class="form-group mb-4">
              <label class="label">Usia Prematur *</label>
              <select class="form-select form-control" name="usia_prematur" id="usia_prematur">
                <option value="" disabled>-- Pilih --</option>
                @for($i=30;$i<=36;$i++)
                  <option value="{{ $i }}" {{ $hasil->usia_lahir_prematur==$i?'selected':'' }}>{{ $i }} Minggu</option>
                @endfor
              </select>
            </div>
          </div>

          <input type="hidden" id="umur_hari" name="umur_hari" />
          <input type="hidden" id="usia_koreksi_prematur" name="usia_koreksi_prematur" />

          <div class="col-lg-12 d-flex gap-3">
            <button type="button" class="btn btn-primary" id="nextStep1">Next</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Step 2 -->
    <div class="step" id="step2" style="display: none">
      <div class="d-flex align-items-center mb-3">
        <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3">2</span>
        <h4 class="fs-18 fw-semibold mb-0" id="judulFormulir"></h4>
      </div>
      <form id="formStep2">
        <div class="row" id="formulirContainer">
          <!-- Formulir akan di-load JS berdasarkan umur -->
        </div>

        <div class="col-lg-12 d-flex gap-3">
          <button type="button" class="btn btn-secondary" id="backStep2">Back</button>
          <button type="button" class="btn btn-primary" id="nextStep2">Next</button>
        </div>
      </form>
    </div>

    <!-- Step 3 -->
    <div class="step" id="step3" style="display: none">
      <div class="d-flex align-items-center mb-3">
        <span class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3">3</span>
        <h4 class="fs-18 fw-semibold mb-0">Review & Submit</h4>
      </div>

      <div id="reviewContainer" class="mb-4">
        <!-- Review data step 1 & 2 akan diinject JS -->
      </div>

      <form action="{{ route('skrinning.siswa.update',$hasil->id) }}" method="POST" id="formStep3" class="form_edit">
        @csrf
        @method('PUT')
        <input type="hidden" name="nama_siswa" />
        <input type="hidden" name="nama_orangtua" />
        <input type="hidden" name="tanggal_lahir" />
        <input type="hidden" name="umur_hari" />
        <input type="hidden" name="formulir_id" />
        <input type="hidden" name="umur_aktual" />
        <input type="hidden" name="prematur_info" />
        <input type="hidden" name="usia_lahir_prematur" />
        <input type="hidden" name="usia_setelah_koreksi" />
        <input type="hidden" name="usia_pembulatan" />

        <button type="button" class="btn btn-secondary" id="backStep3">Back</button>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>

  </div>
</div>
@endsection

@push('scripts')
<script>
  // Toggle usia prematur field
  const prematurSelect = document.querySelector("select[name=prematur]");
  const usiaPrematurWrapper = document.getElementById("usiaPrematurWrapper");
  const usiaPrematur = document.getElementById("usia_prematur");

  function toggleUsiaPrematur() {
    if (prematurSelect.value === "y") {
      usiaPrematurWrapper.style.display = "block";
      usiaPrematur.setAttribute("required", "required");
    } else {
      usiaPrematurWrapper.style.display = "none";
      usiaPrematur.removeAttribute("required");
      usiaPrematur.value = "";
    }
  }
  prematurSelect.addEventListener("change", toggleUsiaPrematur);
  toggleUsiaPrematur();

  let siswaData = {
    nama_siswa: "{{ $hasil->nama_siswa }}",
    nama_orangtua: "{{ $hasil->nama_orangtua }}",
    tanggal_lahir: "{{ $hasil->tanggal_lahir }}",
    prematur: "{{ $hasil->prematur_info === 'YA' ? 'y' : 'n' }}",
    usia_prematur: "{{ $hasil->usia_lahir_prematur }}"
  };
  let formulirData = {!! $formulir ? $formulir->toJson() : '{}' !!};
  let jawaban = {!! json_encode($jawaban) !!};

  // Step 1 Next
  document.getElementById("nextStep1").addEventListener("click", function () {
    const form = document.getElementById("formStep1");
    if (!form.checkValidity()) { form.reportValidity(); return; }

    siswaData.nama_siswa = form.nama_siswa.value;
    siswaData.nama_orangtua = form.nama_orangtua.value;
    siswaData.tanggal_lahir = form.tanggal_lahir.value;
    siswaData.prematur = form.prematur.value;
    siswaData.usia_prematur = form.usia_prematur.value;

    // Hitung umur dan koreksi prematur
    const birth = new Date(siswaData.tanggal_lahir);
    const today = new Date();
    const diffHari = Math.floor((today - birth) / (1000*60*60*24));

    let bulanAktual = Math.floor(diffHari / 30);
    let hariAktual = diffHari % 30;
    let umurAktualStr = `${bulanAktual} bulan ${hariAktual} hari`;

    let totalHariKoreksi = diffHari;
    let usiaKoreksiStr = umurAktualStr;
    let usiaPembulatan = bulanAktual;
    let usiaLahirPrematur = "-";

    if (siswaData.prematur === "y" && siswaData.usia_prematur) {
      const selisihMinggu = 40 - parseInt(siswaData.usia_prematur);
      const koreksiHari = selisihMinggu * 7;
      totalHariKoreksi = diffHari - koreksiHari;
      if (totalHariKoreksi < 0) totalHariKoreksi = 0;
      const bulanKoreksi = Math.floor(totalHariKoreksi / 30);
      const hariKoreksi = totalHariKoreksi % 30;
      usiaKoreksiStr = `${bulanKoreksi} bulan ${hariKoreksi} hari`;
      usiaLahirPrematur = siswaData.usia_prematur + " minggu";
      usiaPembulatan = hariKoreksi > 16 ? bulanKoreksi + 1 : bulanKoreksi;
    } else {
      usiaPembulatan = hariAktual > 16 ? bulanAktual + 1 : bulanAktual;
    }

    siswaData.umur_aktual = umurAktualStr;
    siswaData.usia_lahir_prematur = usiaLahirPrematur;
    siswaData.usia_setelah_koreksi = usiaKoreksiStr;
    siswaData.umur_bulan = usiaPembulatan;

    document.getElementById("umur_hari").value = siswaData.umur_bulan;
    document.getElementById("usia_koreksi_prematur").value = siswaData.usia_setelah_koreksi;

    // Load formulir jika belum ada
    if (!formulirData.pertanyaan || formulirData.pertanyaan.length === 0) {
      fetch(`/skrinning/siswa/formulir/${siswaData.umur_bulan}`)
        .then(res => res.json())
        .then(data => {
          formulirData = data;
          renderFormulir();
        });
    } else {
      renderFormulir();
    }

    document.getElementById("step1").classList.remove("active");
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").classList.add("active");
    document.getElementById("step2").style.display = "block";
  });

  function renderFormulir() {
    let html = "";
    formulirData.pertanyaan.forEach(q => {
      const jaw = jawaban["" + q.id] || '';
      html += `<div class="col-lg-12 mb-4 p-3 border rounded shadow-sm">
                <label class="fw-semibold">${q.nomor}. ${q.teks}</label>`;
      if (q.petunjuk_gambar) {
        html += `<div class="my-2">
                  <img src="/${q.petunjuk_gambar}" class="img-fluid rounded" style="max-height:200px; object-fit:contain;">
                 </div>`;
      }
      html += `<div class="d-flex gap-3">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jawaban[${q.id}]" id="ya${q.id}" value="ya" ${jaw==="ya"?'checked':''}>
                  <label class="form-check-label" for="ya${q.id}">Ya</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="jawaban[${q.id}]" id="tidak${q.id}" value="tidak" ${jaw==="tidak"?'checked':''}>
                  <label class="form-check-label" for="tidak${q.id}">Tidak</label>
                </div>
               </div>
               <input type="hidden" name="bobot[${q.id}]" value="${q.bobot_nilai}">
               </div>`;
    });
    document.getElementById("judulFormulir").innerHTML =
      "Formulir: " + formulirData.judul + " (Umur: " + formulirData.usia_min + " - " + formulirData.usia_max + " bulan)";
    document.getElementById("formulirContainer").innerHTML = html;
  }

  // Step2 Back
  document.getElementById("backStep2").addEventListener("click", function () {
    document.getElementById("step2").classList.remove("active");
    document.getElementById("step2").style.display = "none";
    document.getElementById("step1").classList.add("active");
    document.getElementById("step1").style.display = "block";
  });

  // Step2 Next
  document.getElementById("nextStep2").addEventListener("click", function () {
    const inputs = document.querySelectorAll("#formStep2 input[type=radio]:checked");
    if (inputs.length !== formulirData.pertanyaan.length) {
      alert("Silakan jawab semua pertanyaan!");
      return;
    }

    jawaban = {};
    inputs.forEach(i => { jawaban[i.name.replace('jawaban[','').replace(']','')] = i.value; });

    let reviewHtml = `
      <div class="card mb-3 p-3 shadow-sm">
        <p><strong>Nama Siswa:</strong> ${siswaData.nama_siswa}</p>
        <p><strong>Nama Orang Tua:</strong> ${siswaData.nama_orangtua}</p>
        <p><strong>Tanggal Lahir:</strong> ${new Date(siswaData.tanggal_lahir).toLocaleDateString('id-ID',{year:'numeric',month:'long',day:'numeric'})}</p>
        <p><strong>Usia Aktual:</strong> ${siswaData.umur_aktual}</p>
        <p><strong>Prematur:</strong> ${siswaData.prematur==="y"?"YA":"TIDAK"}</p>
        <p><strong>Usia Lahir Prematur:</strong> ${siswaData.usia_lahir_prematur}</p>
        <p><strong>Usia setelah dikoreksi:</strong> ${siswaData.usia_setelah_koreksi}</p>
        <p><strong>Usia setelah pembulatan:</strong> ${siswaData.umur_bulan} bulan</p>
      </div>`;

    for (let key in jawaban) {
      const q = formulirData.pertanyaan.find(x => x.id == key);
      reviewHtml += `
        <div class="card mb-2 p-3 shadow-sm">
          <div class="d-flex justify-content-between align-items-center">
            <span><strong>${q.nomor}. ${q.teks} (${q.kategori})</strong></span>        
            <span class="badge ${jawaban[key]=="ya"?"bg-success":"bg-danger"} text-white">${jawaban[key].toUpperCase()}</span>
          </div>
        </div>`;
    }

    document.getElementById("reviewContainer").innerHTML = reviewHtml;

    // Isi formStep3 dengan data
    const formStep3 = document.getElementById("formStep3");
    formStep3.nama_siswa.value = siswaData.nama_siswa;
    formStep3.nama_orangtua.value = siswaData.nama_orangtua;
    formStep3.tanggal_lahir.value = siswaData.tanggal_lahir;
    formStep3.umur_aktual.value = siswaData.umur_aktual;
    formStep3.prematur_info.value = siswaData.prematur==="y"?"YA":"TIDAK";
    formStep3.usia_lahir_prematur.value = siswaData.usia_lahir_prematur.replace("minggu","").trim();
    formStep3.usia_setelah_koreksi.value = siswaData.usia_setelah_koreksi;
    formStep3.usia_pembulatan.value = siswaData.umur_bulan;
    if (formulirData && formulirData.id) formStep3.formulir_id.value = formulirData.id;

    // Hapus jawaban lama jika ada
    Array.from(formStep3.querySelectorAll('input[name^="jawaban"]')).forEach(i=>i.remove());
    for (let key in jawaban) {
      const input = document.createElement("input");
      input.type = "hidden"; input.name = "jawaban[" + key + "]"; input.value = jawaban[key];
      formStep3.appendChild(input);
    }

    document.getElementById("step2").classList.remove("active");
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").classList.add("active");
    document.getElementById("step3").style.display = "block";
  });

  // Step3 Back
  document.getElementById("backStep3").addEventListener("click", function () {
    document.getElementById("step3").classList.remove("active");
    document.getElementById("step3").style.display = "none";
    document.getElementById("step2").classList.add("active");
    document.getElementById("step2").style.display = "block";
  });

  // Jika ingin pre-fill data edit
  document.addEventListener("DOMContentLoaded", function () {
    toggleUsiaPrematur();
    // Step 1 sudah aktif, Step 2 akan load formulir otomatis ketika klik next
    // Jawaban dari DB akan pre-check saat formulir di-render
  });
</script>
@endpush

