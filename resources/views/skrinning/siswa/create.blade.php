@extends('app') @section('content')
<div class="card bg-white border-0 rounded-3 mb-4">
  <div class="card-body p-4">
    <!-- Step 1 -->
    <div class="step active" id="step1">
      <div class="d-flex align-items-center mb-3">
        <span
          class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3"
          >1</span
        >
        <h4 class="fs-18 fw-semibold mb-0">Data Siswa</h4>
      </div>
      <form id="formStep1">
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group mb-4">
              <label class="label">Nama Siswa *</label>
              <input
                type="text"
                class="form-control"
                name="nama_siswa"
                required
              />
            </div>
          </div>
          <div class="col-lg-6">
            <div class="form-group mb-4">
              <label class="label">Nama Orang Tua (Opsional)</label>
              <input type="text" class="form-control" name="nama_orangtua" />
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label class="label">Tanggal Lahir *</label>
                <input
                  type="date"
                  class="form-control"
                  name="tgl_lahir"
                  id="tgl_lahir"
                  required
                />
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group mb-4">
                <label class="label"
                  >Apakah anak dilahirkan dalam keadaan prematur *</label
                >
                <select
                  class="form-select form-control"
                  name="prematur"
                  required
                >
                  <option value="" selected disabled>-- Pilih --</option>
                  <option value="y">Ya</option>
                  <option value="n">Tidak</option>
                </select>
              </div>
            </div>
          </div>
          <div class="col-lg-6" id="usiaPrematurWrapper" style="display: none">
            <div class="form-group mb-4">
              <label class="label">Usia Prematur *</label>
              <select
                class="form-select form-control"
                name="usia_prematur"
                id="usia_prematur"
              >
                <option value="" selected disabled>-- Pilih --</option>
                <option value="30">30 Minggu</option>
                <option value="31">31 Minggu</option>
                <option value="32">32 Minggu</option>
                <option value="33">33 Minggu</option>
                <option value="34">34 Minggu</option>
                <option value="35">35 Minggu</option>
                <option value="36">36 Minggu</option>
              </select>
            </div>
          </div>

          <input type="hidden" id="umur_hari" name="umur_hari" />
          <input
            type="hidden"
            id="usia_koreksi_prematur"
            name="usia_koreksi_prematur"
          />
          <div class="col-lg-12 d-flex gap-3">
            <button type="button" class="btn btn-primary" id="nextStep1">
              Next
            </button>
          </div>
        </div>
      </form>
    </div>

    <!-- Step 2 -->
    <div class="step" id="step2" style="display: none">
      <div class="d-flex align-items-center mb-3">
        <span
          class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3"
          >2</span
        >
        <h4 class="fs-18 fw-semibold mb-0" id="judulFormulir"></h4>
      </div>
      <form id="formStep2">
        <div class="row" id="formulirContainer">
          <!-- Formulir akan di-load JS berdasarkan umur -->
        </div>

        <div class="col-lg-12 d-flex gap-3">
          <button type="button" class="btn btn-secondary" id="backStep2">
            Back
          </button>
          <button type="button" class="btn btn-primary" id="nextStep2">
            Next
          </button>
        </div>
      </form>
    </div>

    <!-- Step 3 -->
    <div class="step" id="step3" style="display: none">
      <div class="d-flex align-items-center mb-3">
        <span
          class="fs-20 fw-bold text-primary wh-48 bg-primary bg-opacity-10 rounded-circle d-inline-flex justify-content-center align-items-center me-3"
          >3</span
        >
        <h4 class="fs-18 fw-semibold mb-0">Review & Submit</h4>
      </div>

      <div id="reviewContainer" class="mb-4">
        <!-- Review data step 1 & 2 akan diinject JS -->
      </div>

      <form
        action="{{ route('skrinning.siswa.store') }}"
        method="POST"
        id="formStep3"
        class="form_save"
      >
        @csrf
        <input type="hidden" name="nama_siswa" />
        <input type="hidden" name="nama_orangtua" />
        <input type="hidden" name="tgl_lahir" />
        <input type="hidden" name="umur_hari" />
        <input type="hidden" name="formulir_id" />
        <input type="hidden" name="umur_aktual" />
        <input type="hidden" name="prematur_info" />
        <input type="hidden" name="usia_lahir_prematur" />
        <input type="hidden" name="usia_setelah_koreksi" />
        <input type="hidden" name="usia_pembulatan" />

        <button type="button" class="btn btn-secondary" id="backStep3">
          Back
        </button>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection 


@push('scripts')

<script>
  // Toggle usia prematur field
  document
    .querySelector("select[name=prematur]")
    .addEventListener("change", function () {
      const wrapper = document.getElementById("usiaPrematurWrapper");
      const usiaPrematur = document.getElementById("usia_prematur");

      if (this.value === "y") {
        wrapper.style.display = "block";
        usiaPrematur.setAttribute("required", "required");
      } else {
        wrapper.style.display = "none";
        usiaPrematur.removeAttribute("required");
        usiaPrematur.value = ""; // reset pilihan
      }
    });
</script>

<script>
  let siswaData = {};
  let formulirData = {};
  let jawaban = {};

  // Step 1 Next
document.getElementById("nextStep1").addEventListener("click", function () {
  const form = document.getElementById("formStep1");
  if (!form.checkValidity()) { form.reportValidity(); return; }

  const nama_siswa = form.nama_siswa.value;
  const nama_orangtua = form.nama_orangtua.value;
  const tgl_lahir = form.tgl_lahir.value;
  const prematur = form.prematur.value;
  const usia_prematur = form.usia_prematur.value;

  const birth = new Date(tgl_lahir);
  const today = new Date();
  const diffHari = Math.floor((today - birth) / (1000*60*60*24));

  // Usia aktual
  let bulanAktual = Math.floor(diffHari / 30);
  let hariAktual = diffHari % 30;
  let umurAktualStr = `${bulanAktual} bulan ${hariAktual} hari`;

  // Koreksi prematur
  let totalHariKoreksi = diffHari;
  let usiaKoreksiStr = umurAktualStr;
  let usiaPembulatan = bulanAktual;
  let usiaLahirPrematur = "-";

  if (prematur === "y" && usia_prematur) {
    const selisihMinggu = 40 - parseInt(usia_prematur);
    const koreksiHari = selisihMinggu * 7;
    totalHariKoreksi = diffHari - koreksiHari;
    if (totalHariKoreksi < 0) totalHariKoreksi = 0;
    const bulanKoreksi = Math.floor(totalHariKoreksi / 30);
    const hariKoreksi = totalHariKoreksi % 30;
    usiaKoreksiStr = `${bulanKoreksi} bulan ${hariKoreksi} hari`;
    usiaLahirPrematur = usia_prematur + " minggu";
    // pembulatan
    usiaPembulatan = hariKoreksi > 16 ? bulanKoreksi + 1 : bulanKoreksi;
  } else {
    usiaPembulatan = hariAktual > 16 ? bulanAktual + 1 : bulanAktual;
  }

  siswaData = {
    nama_siswa,
    nama_orangtua,
    tgl_lahir,
    prematur,
    usia_prematur,
    umur_aktual: umurAktualStr,
    usia_lahir_prematur: usiaLahirPrematur,
    usia_setelah_koreksi: usiaKoreksiStr,
    umur_bulan: usiaPembulatan
  };

  // set hidden input step1
  document.getElementById("umur_hari").value = siswaData.umur_bulan;
  document.getElementById("usia_koreksi_prematur").value = siswaData.usia_setelah_koreksi;

  // load formulir sesuai umur_bulan
  fetch(`/skrinning/siswa/formulir/${siswaData.umur_bulan}`)
    .then(res => res.json())
    .then(data => {
      formulirData = data;
      let html = "";
      data.pertanyaan.forEach(q => {
        html += `<div class="col-lg-12 mb-4 p-3 border rounded shadow-sm">
                  <label class="fw-semibold">${q.nomor}. ${q.teks}</label>`;
        if (q.petunjuk_gambar) {
          html += `<div class="my-2">
                    <img src="/${q.petunjuk_gambar}" class="img-fluid rounded" style="max-height:200px; object-fit:contain;">
                   </div>`;
        }
        html += `<div class="d-flex gap-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[${q.id}]" id="ya${q.id}" value="ya">
                    <label class="form-check-label" for="ya${q.id}">Ya</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="jawaban[${q.id}]" id="tidak${q.id}" value="tidak">
                    <label class="form-check-label" for="tidak${q.id}">Tidak</label>
                  </div>
                 </div>
                 <input type="hidden" name="bobot[${q.id}]" value="${q.bobot_nilai}">
                 </div>`;
      });
      document.getElementById("judulFormulir").innerHTML =
        "Formulir: " + data.judul + " (Umur: " + data.usia_min + " - " + data.usia_max + " bulan)";
      document.getElementById("formulirContainer").innerHTML = html;
    });

  // Show step2
  document.getElementById("step1").classList.remove("active");
  document.getElementById("step1").style.display = "none";
  document.getElementById("step2").classList.add("active");
  document.getElementById("step2").style.display = "block";
});

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
  inputs.forEach(i => { jawaban[i.name] = i.value; });

  // Review HTML
  let reviewHtml = `
    <div class="card mb-3 p-3 shadow-sm">
      <p><strong>Nama Siswa:</strong> ${siswaData.nama_siswa}</p>
      <p><strong>Nama Orang Tua:</strong> ${siswaData.nama_orangtua}</p>
      <p><strong>Tanggal Lahir:</strong> ${new Date(siswaData.tgl_lahir).toLocaleDateString('id-ID',{year:'numeric',month:'long',day:'numeric'})}</p>
      <p><strong>Usia Aktual:</strong> ${siswaData.umur_aktual}</p>
      <p><strong>Prematur:</strong> ${siswaData.prematur==="y"?"YA":"TIDAK"}</p>
      <p><strong>Usia Lahir Prematur:</strong> ${siswaData.usia_lahir_prematur}</p>
      <p><strong>Usia setelah dikoreksi:</strong> ${siswaData.usia_setelah_koreksi}</p>
      <p><strong>Usia setelah pembulatan:</strong> ${siswaData.umur_bulan} bulan</p>
    </div>`;

  for (let key in jawaban) {
    const q = formulirData.pertanyaan.find(x => "jawaban[" + x.id + "]" === key);
    reviewHtml += `
      <div class="card mb-2 p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center">
          <span><strong>${q.nomor}. ${q.teks} (${q.kategori})</strong></span>        
          <span class="badge ${jawaban[key]=="ya"?"bg-success":"bg-danger"} text-white">${jawaban[key].toUpperCase()}</span>
        </div>
      </div>`;
  }

  document.getElementById("reviewContainer").innerHTML = reviewHtml;

  // set hidden input step3
  const formStep3 = document.getElementById("formStep3");
  formStep3.nama_siswa.value = siswaData.nama_siswa;
  formStep3.nama_orangtua.value = siswaData.nama_orangtua;
  formStep3.tgl_lahir.value = siswaData.tgl_lahir;
  formStep3.umur_aktual.value = siswaData.umur_aktual;
  formStep3.prematur_info.value = siswaData.prematur==="y"?"YA":"TIDAK";
  formStep3.usia_lahir_prematur.value = siswaData.usia_lahir_prematur.replace("minggu", "").trim();
  formStep3.usia_setelah_koreksi.value = siswaData.usia_setelah_koreksi;
  formStep3.usia_pembulatan.value = siswaData.umur_bulan;
  if (formulirData && formulirData.id) {
    formStep3.formulir_id.value = formulirData.id;
  }

  Array.from(formStep3.querySelectorAll('input[name^="jawaban"]')).forEach(i=>i.remove());
  for (let key in jawaban) {
    const input = document.createElement("input");
    input.type = "hidden"; input.name = key; input.value = jawaban[key];
    formStep3.appendChild(input);
  }

  // Show step3
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

  
</script>

@endpush
