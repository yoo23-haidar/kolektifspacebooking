# System Diagrams - KolektifSpace

Dokumentasi visual untuk sistem booking ruang kerja KolektifSpace.

---

## 1. Context Diagram

Diagram konteks menunjukkan hubungan sistem dengan entitas eksternal.

```mermaid
flowchart TB
    subgraph External["External Entities"]
        Guest["👤 Guest<br/>(Pengunjung)"]
        Admin["👨‍💼 Admin<br/>(Pengelola)"]
    end
    
    subgraph System["🏢 KolektifSpace System"]
        App["Sistem Booking<br/>Ruang Kerja"]
    end
    
    Guest -->|"Melihat ruang,<br/>Membuat booking,<br/>Upload bukti bayar"| App
    App -->|"Info ruang,<br/>Konfirmasi booking,<br/>Status pembayaran"| Guest
    
    Admin -->|"Login,<br/>Kelola ruang,<br/>Approve/Cancel booking"| App
    App -->|"Dashboard,<br/>Laporan booking,<br/>Notifikasi"| Admin
```

---

## 2. Data Flow Diagram (DFD) Level 0

DFD Level 0 menunjukkan proses utama sistem.

```mermaid
flowchart LR
    Guest((Guest))
    Admin((Admin))
    
    subgraph "KolektifSpace System"
        P1[["1.0<br/>Kelola<br/>Ruang"]]
        P2[["2.0<br/>Proses<br/>Booking"]]
        P3[["3.0<br/>Kelola<br/>Pembayaran"]]
        P4[["4.0<br/>Kelola<br/>Pengguna"]]
    end
    
    D1[(Spaces)]
    D2[(Bookings)]
    D3[(Users)]
    
    Guest -->|"Request Info Ruang"| P1
    P1 -->|"Data Ruang"| Guest
    P1 <-->|"CRUD Ruang"| D1
    
    Guest -->|"Data Booking"| P2
    P2 -->|"Konfirmasi"| Guest
    P2 <-->|"Simpan Booking"| D2
    P2 -->|"Cek Ketersediaan"| D1
    
    Guest -->|"Bukti Bayar"| P3
    P3 -->|"Status Bayar"| Guest
    P3 <-->|"Update Status"| D2
    
    Admin -->|"Login"| P4
    P4 <-->|"Autentikasi"| D3
    Admin -->|"Kelola Booking"| P2
    Admin -->|"Kelola Ruang"| P1
```

---

## 3. Data Flow Diagram (DFD) Level 1 - Proses Booking

Detail proses booking.

```mermaid
flowchart TB
    Guest((Guest))
    
    subgraph "2.0 Proses Booking"
        P21["2.1<br/>Pilih Ruang"]
        P22["2.2<br/>Pilih Waktu"]
        P23["2.3<br/>Isi Data Guest"]
        P24["2.4<br/>Kalkulasi Harga"]
        P25["2.5<br/>Simpan Booking"]
    end
    
    D1[(Spaces)]
    D2[(Bookings)]
    
    Guest -->|"Pilih Tipe Ruang"| P21
    D1 -->|"Daftar Ruang"| P21
    P21 -->|"Ruang Terpilih"| P22
    
    P22 -->|"Cek Jadwal"| D2
    D2 -->|"Jadwal Terisi"| P22
    P22 -->|"Waktu Valid"| P23
    
    Guest -->|"Nama, Email, WA"| P23
    P23 -->|"Data Guest"| P24
    
    D1 -->|"Harga"| P24
    P24 -->|"Total Harga"| P25
    
    P25 -->|"Booking Baru"| D2
    P25 -->|"Konfirmasi"| Guest
```

---

## 4. Entity Relationship Diagram (ERD)

Diagram hubungan antar entitas database.

```mermaid
erDiagram
    USERS {
        bigint id PK
        string name
        string email UK
        string password
        boolean is_admin
        timestamp email_verified_at
        timestamp created_at
        timestamp updated_at
    }
    
    SPACES {
        bigint id PK
        string name
        string slug UK
        string type
        integer capacity
        string dimensions
        string location
        string sub_location
        decimal price_hourly
        decimal price_3_hours
        decimal price_6_hours
        decimal price_daily
        decimal price_weekly
        decimal price_monthly
        text amenities
        text description
        string image
        boolean is_active
        timestamp created_at
        timestamp updated_at
    }
    
    BOOKINGS {
        ulid id PK
        string guest_name
        string guest_email
        string guest_whatsapp
        string company_name
        bigint space_id FK
        date booking_date
        time start_time
        datetime end_time
        integer duration
        string duration_unit
        integer total_guests
        decimal total_price
        enum status
        enum payment_status
        timestamp created_at
        timestamp updated_at
    }
    
    UNAVAILABLE_DATES {
        bigint id PK
        bigint space_id FK
        datetime start_date
        datetime end_date
        string reason
        timestamp created_at
        timestamp updated_at
    }
    
    SPACES ||--o{ BOOKINGS : "has many"
    SPACES ||--o{ UNAVAILABLE_DATES : "has many"
```

---

## 5. Flowchart - Proses Booking Guest

Alur lengkap proses booking dari perspektif guest.

```mermaid
flowchart TD
    A([Start]) --> B[Buka Homepage]
    B --> C[Klik Explore]
    C --> D[Pilih Tipe Ruang]
    D --> E[Lihat Detail Ruang]
    E --> F{Ruang Tersedia?}
    
    F -->|Tidak| G[Pilih Ruang Lain]
    G --> D
    
    F -->|Ya| H[Klik Book Now]
    H --> I[Pilih Tanggal]
    I --> J[Pilih Waktu Mulai]
    J --> K[Pilih Durasi]
    K --> L{Jadwal Bentrok?}
    
    L -->|Ya| M[Tampil Error]
    M --> J
    
    L -->|Tidak| N[Isi Data Guest]
    N --> O[Nama, Email, WA, Perusahaan]
    O --> P[Review Booking]
    P --> Q{Konfirmasi?}
    
    Q -->|Tidak| R[Edit Data]
    R --> N
    
    Q -->|Ya| S[Submit Booking]
    S --> T[Booking Tersimpan]
    T --> U[Tampil Halaman Payment]
    U --> V[Upload Bukti Bayar]
    V --> W[Kirim WhatsApp ke Admin]
    W --> X([End])
```

---

## 6. Flowchart - Proses Approval Admin

Alur proses approval booking oleh admin.

```mermaid
flowchart TD
    A([Start]) --> B[Admin Login]
    B --> C[Buka Dashboard]
    C --> D[Lihat Pending Bookings]
    D --> E[Pilih Booking]
    E --> F[Lihat Detail Booking]
    F --> G{Cek Bukti Bayar}
    
    G -->|Tidak Valid| H[Klik Cancel]
    H --> I[Isi Alasan Cancel]
    I --> J[Status = Cancelled]
    J --> K([End])
    
    G -->|Valid| L[Klik Approve]
    L --> M[Status = Confirmed]
    M --> N[Payment = Paid]
    N --> K
```

---

## 7. Use Case Diagram

Diagram use case menunjukkan fungsionalitas sistem.

```mermaid
flowchart TB
    subgraph Actors
        Guest["👤 Guest"]
        Admin["👨‍💼 Admin"]
    end
    
    subgraph "KolektifSpace System"
        UC1["📋 Lihat Daftar Ruang"]
        UC2["🔍 Filter Ruang"]
        UC3["📄 Lihat Detail Ruang"]
        UC4["📝 Buat Booking"]
        UC5["💳 Upload Bukti Bayar"]
        UC6["🔐 Login"]
        UC7["📊 Lihat Dashboard"]
        UC8["✅ Approve Booking"]
        UC9["❌ Cancel Booking"]
        UC10["🏢 Kelola Ruang"]
        UC11["📈 Lihat Laporan"]
    end
    
    Guest --> UC1
    Guest --> UC2
    Guest --> UC3
    Guest --> UC4
    Guest --> UC5
    
    Admin --> UC6
    Admin --> UC7
    Admin --> UC8
    Admin --> UC9
    Admin --> UC10
    Admin --> UC11
```

---

## Legenda

| Simbol | Keterangan |
|--------|------------|
| `○` | External Entity (Aktor) |
| `□` | Proses |
| `▭` | Data Store |
| `→` | Aliran Data |
| `PK` | Primary Key |
| `FK` | Foreign Key |
| `UK` | Unique Key |
