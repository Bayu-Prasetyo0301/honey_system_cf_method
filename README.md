# 🍯 Sistem Rekomendasi Jenis Madu untuk Kesehatan  
### *Metode Certainty Factor (CF)*

Repositori ini berisi **sistem pakar berbasis web** yang dirancang untuk memberikan **rekomendasi jenis madu yang tepat** berdasarkan kondisi kesehatan pengguna.  
Sistem menggunakan **metode Certainty Factor (CF)** untuk menangani ketidakpastian dan menghitung tingkat keyakinan diagnosis secara kuantitatif dan terukur.

---

## 📌 Deskripsi Singkat
Sistem ini membantu pengguna menentukan jenis madu yang paling sesuai dengan gejala kesehatan yang dialami.  
Hasil rekomendasi disajikan dalam bentuk **persentase tingkat keyakinan**, lengkap dengan **deskripsi manfaat madu**, sehingga mudah dipahami dan bermanfaat sebagai sistem pendukung keputusan.

---

## 🚀 Fitur Utama

### 👤 Sisi Pengguna (Client Side)
- **Menu Home**  
  Halaman utama sistem dengan informasi umum.
<img width="1024" height="464" alt="image" src="https://github.com/user-attachments/assets/3c1c740d-25d3-418a-a5a9-ec6c4067d296" />
<img width="625" height="765" alt="image" src="https://github.com/user-attachments/assets/ebb5559c-bfdd-40e5-af23-5a7aaf576f26" />

- **Menu Konsultasi dan pilih skala keyakinan**  
  Pengguna mengisi data diri dan memilih gejala kesehatan serta memilih skala keyakinan pengguna (misalnya: *Tidak Yakin* hingga *Sangat Yakin*).<br>
  
<img width="844" height="803" alt="image" src="https://github.com/user-attachments/assets/03429693-e336-436d-9a17-9283692d306f" />
  
- **Hasil Diagnosis**  
  Menampilkan:
  - Persentase tingkat keyakinan sistem
  - Rekomendasi jenis madu
  - Deskripsi dan manfaat madu
    
<img width="762" height="194" alt="image" src="https://github.com/user-attachments/assets/30b20ab9-7ed3-409d-a6b0-5c68eda79990" />

<img width="756" height="776" alt="image" src="https://github.com/user-attachments/assets/357fda09-6bb6-49a6-b22b-2cee3af41378" />

<img width="750" height="804" alt="image" src="https://github.com/user-attachments/assets/e2b522f7-d1ac-4acc-8975-0d8b167c71e8" />

- **Menu Petunjuk**  
  Panduan penggunaan sistem.<br>
<img width="613" height="872" alt="image" src="https://github.com/user-attachments/assets/da884fb4-2e81-4d7e-9f1c-48b4fc6a8296" />

- **Menu Tentang**  
  Informasi singkat tentang sistem dan toko madu.<br>
<img width="1211" height="730" alt="image" src="https://github.com/user-attachments/assets/60b36957-6f83-4c33-b61f-d10e68f501f7" />

- **Menu Developer**  
  Informasi mengenai pembuat/penerapan sistem.<br>
<img width="1125" height="834" alt="image" src="https://github.com/user-attachments/assets/24fa54c1-578e-46e6-a56d-28d4f78eb168" />

---

### 🔐 Sisi Administrator (Admin Panel)
- **Dashboard Admin**
  - Total data gejala
  - Total data solusi (jenis madu)
  - Total rule (aturan)
  - Riwayat konsultasi <br>
<img width="1885" height="554" alt="image" src="https://github.com/user-attachments/assets/37d91285-f5a6-4aee-b1fb-295d43271b04" />
<img width="1905" height="500" alt="image" src="https://github.com/user-attachments/assets/6e0f15c3-7bfc-4370-a8df-58cb0c5b2a60" />
  
- **Pengelolaan Data Gejala**<br>
<img width="1896" height="919" alt="image" src="https://github.com/user-attachments/assets/878a32da-3ddd-4b61-ae93-344a875c5194" />
  
- **Pengelolaan Data Solusi (Jenis Madu)**
  - Nama madu
  - Manfaat kesehatan
  - Deskripsi
  - Harga <br>
<img width="1888" height="845" alt="image" src="https://github.com/user-attachments/assets/f868d771-a2e4-4cc2-bb0e-a4c8510eb331" />


- **Pengelolaan Data Rule**
  - Aturan berbasis IF–THEN
  - Nilai Certainty Factor dari pakar <br>
<img width="1897" height="886" alt="image" src="https://github.com/user-attachments/assets/f29a370a-2fc6-4318-839c-5e84652874f8" />

---

## 🧠 Metode yang Digunakan
### Certainty Factor (CF)
Metode Certainty Factor digunakan untuk:
- Mengakomodasi ketidakpastian data
- Menggabungkan nilai keyakinan pakar dan pengguna
- Menghasilkan nilai persentase tingkat kepercayaan diagnosis

---

## 🛠️ Teknologi yang Digunakan
- **Frontend**:  
  HTML, CSS, JavaScript, Bootstrap 5
- **Backend**:  
  PHP
- **Database**:  
  MySQL

---

## 📂 Cara Instalasi

1. Clone repositori:
   ```bash
   git clone https://github.com/Bayu-Prasetyo0301/honey_system_cf_method.git
