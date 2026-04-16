CREATE DATABASE IF NOT EXISTS dishub_event;
USE dishub_event;

-- =========================
-- TABEL ADMIN
-- =========================
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES
(
    'admin',
    '$2y$10$9qJ3p9p9RZxYkq3ZKQbH6uL2j2ZzXK0k8fGQm5H2M9MZr9wX0w7mW'
);

-- =========================
-- TABEL EVENTS (Bukan "event")
-- =========================
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_event VARCHAR(100) NOT NULL,
    tanggal_event DATE NOT NULL,
    deskripsi TEXT
);

-- =========================
-- TABEL PESERTA
-- =========================
CREATE TABLE peserta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    jabatan VARCHAR(100),
    bidang VARCHAR(100),
    no_hp VARCHAR(20),
    tanggal_event DATE,
    event_id INT,
    tanda_tangan LONGTEXT,
    CONSTRAINT fk_event FOREIGN KEY (event_id) REFERENCES events(id)
);
