CREATE TABLE user( 
	id INT AUTO_INCREMENT, 
	username VARCHAR(50), 
    	password VARCHAR(255), 
	PRIMARY KEY(id)
);

CREATE TABLE buku( 
	id INT AUTO_INCREMENT, 
	judul VARCHAR(100), 
	penulis VARCHAR(50), 
	tahun VARCHAR(10), 
	penerbit VARCHAR(80), 
	lokasi VARCHAR(100), 
	status VARCHAR(20), 
	PRIMARY KEY(id) 
);