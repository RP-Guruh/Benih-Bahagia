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
          <input type="hidden" id="umur_hari" name="umur_hari" />
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
        <button type="button" class="btn btn-secondary" id="backStep3">
          Back
        </button>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection @push('scripts')

<script>
  let siswaData = {};
  let formulirData = {};
  let jawaban = {};

  // Step 1 Next
  document.getElementById("nextStep1").addEventListener("click", function () {
    const form = document.getElementById("formStep1");
    if (!form.checkValidity()) {
      form.reportValidity();
      return;
    }

    const nama_siswa = form.nama_siswa.value;
    const nama_orangtua = form.nama_orangtua.value;
    const tgl_lahir = form.tgl_lahir.value;

    const birth = new Date(tgl_lahir);
    const today = new Date();
    let months = (today.getFullYear() - birth.getFullYear()) * 12;
    
    months -= birth.getMonth();
    months += today.getMonth();
    let daysDiff = today.getDate() - birth.getDate();
    if (daysDiff > 17) months += 1;
    const umur_aktual = `${months} bulan ${daysDiff} hari`;
   
    siswaData = { nama_siswa, nama_orangtua, tgl_lahir, umur_bulan: months, umur_aktual: umur_aktual };
    document.getElementById("umur_hari").value = months;

    // load formulir sesuai umur
    fetch(`/skrinning/siswa/formulir/${months}`)
      .then((res) => res.json())
      .then((data) => {
        formulirData = data;
        let html = "";
        data.pertanyaan.forEach((q) => {
          html += `<div class="col-lg-12 mb-4 p-3 border rounded shadow-sm">
                        <label class="fw-semibold">${q.nomor}. ${q.teks}</label>`;
          if (q.petunjuk_gambar) {
            html += `<div class="my-2">
                            <img src="/${q.petunjuk_gambar}" 
                                 class="img-fluid rounded" 
                                 style="max-height:200px; object-fit:contain;">
                         </div>`;
          }
          html += `<div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                   name="jawaban[${q.id}]" id="ya${q.id}" value="ya">
                            <label class="form-check-label" for="ya${q.id}">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" 
                                   name="jawaban[${q.id}]" id="tidak${q.id}" value="tidak">
                            <label class="form-check-label" for="tidak${q.id}">Tidak</label>
                        </div>
                     </div>
                     <input type="hidden" name="bobot[${q.id}]" value="${q.bobot_nilai}">
                     </div>`;
        });

        document.getElementById("judulFormulir").innerHTML =
          "Formulir: " +
          data.judul +
          " (Umur: " +
          data.usia_min +
          " - " +
          data.usia_max +
          " bulan)";
        document.getElementById("formulirContainer").innerHTML = html;
      });

    // show step2
    document.getElementById("step1").classList.remove("active");
    document.getElementById("step1").style.display = "none";
    document.getElementById("step2").classList.add("active");
    document.getElementById("step2").style.display = "block";
  });

  // Step 2 Back
  document.getElementById("backStep2").addEventListener("click", function () {
    document.getElementById("step2").classList.remove("active");
    document.getElementById("step2").style.display = "none";
    document.getElementById("step1").classList.add("active");
    document.getElementById("step1").style.display = "block";
  });

  // Step 2 Next
  document.getElementById("nextStep2").addEventListener("click", function () {
    const inputs = document.querySelectorAll(
      "#formStep2 input[type=radio]:checked"
    );
    if (inputs.length !== formulirData.pertanyaan.length) {
      alert("Silakan jawab semua pertanyaan!");
      return;
    }

    jawaban = {};
    inputs.forEach((i) => {
      jawaban[i.name] = i.value;
    });

    let reviewHtml = "";

    // Card info formulir dan catatan
    reviewHtml += `
        <div class="card mb-3 p-3 shadow-sm border-info">
            <div class="mb-2">
                <strong>Formulir Digunakan:</strong> ${formulirData.judul} 
                (Umur: ${formulirData.usia_min} - ${formulirData.usia_max} bulan)
            </div>
            <div class="alert alert-warning mb-0">
                 Hasil evaluasi dari kuesioner akan tersimpan setelah menekan tombol <strong>Submit</strong>.
            </div>
        </div>
    `;

    // Card info siswa
    reviewHtml += `
        <div class="card mb-3 p-3 shadow-sm">
            <p><strong>Nama Siswa:</strong> ${siswaData.nama_siswa}</p>
            <p><strong>Nama Orang Tua:</strong> ${siswaData.nama_orangtua}</p>
            <p><strong>Tanggal Lahir:</strong> ${siswaData.tgl_lahir}</p>
            <p><strong>Usia Aktual :</strong> ${siswaData.umur_aktual}</p>
            <p><strong>Usia setelah pembulatan :</strong> ${siswaData.umur_bulan} bulan</p>
            
            
        </div>
    `;

    for (let key in jawaban) {
      const q = formulirData.pertanyaan.find(
        (x) => "jawaban[" + x.id + "]" === key
      );
      reviewHtml += `
            <div class="card mb-2 p-3 shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <span><strong>${q.nomor}. ${q.teks} (${
        q.kategori
      })</strong></span>        
                    <span class="badge ${
                      jawaban[key] == "ya" ? "bg-success" : "bg-danger"
                    } text-white">${jawaban[key].toUpperCase()}</span>
                </div>
            </div>
        `;
    }

    document.getElementById("reviewContainer").innerHTML = reviewHtml;

    // set hidden input step3
    const formStep3 = document.getElementById("formStep3");
    formStep3.nama_siswa.value = siswaData.nama_siswa;
    formStep3.nama_orangtua.value = siswaData.nama_orangtua;
    formStep3.tgl_lahir.value = siswaData.tgl_lahir;
    formStep3.formulir_id.value = formulirData.id;
    formStep3.usia_pembulatan = siswaData.umur_bulan;

    Array.from(formStep3.querySelectorAll('input[name^="jawaban"]')).forEach(
      (i) => i.remove()
    );
    for (let key in jawaban) {
      const input = document.createElement("input");
      input.type = "hidden";
      input.name = key;
      input.value = jawaban[key];
      formStep3.appendChild(input);
    }

    // show step3
    document.getElementById("step2").classList.remove("active");
    document.getElementById("step2").style.display = "none";
    document.getElementById("step3").classList.add("active");
    document.getElementById("step3").style.display = "block";
  });

  // Step 3 Back
  document.getElementById("backStep3").addEventListener("click", function () {
    document.getElementById("step3").classList.remove("active");
    document.getElementById("step3").style.display = "none";
    document.getElementById("step2").classList.add("active");
    document.getElementById("step2").style.display = "block";
  });
</script>

@endpush
