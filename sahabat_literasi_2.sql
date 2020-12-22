
drop table if exists ADMIN;

drop table if exists BUKU;

drop table if exists CATATAN_PEMINJAMAN;

drop table if exists PEMINJAM;

/*==============================================================*/
/* Table: ADMIN                                                 */
/*==============================================================*/
create table ADMIN
(
   ID_ADMIN                       int                            not null,
   NAMA                           char(50),
   JABATAN                        varchar(50),
   primary key (ID_ADMIN)
);

/*==============================================================*/
/* Table: BUKU                                                  */
/*==============================================================*/
create table BUKU
(
   ID_PEMINJAM                    int                            not null,
   ID_ADMIN                       int                            not null,
   KODE_BUKU                      varchar(20)                    not null,
   NAMA_BUKU                      varchar(50),
   PENULIS                        varchar(50),
   TAHUN_TERBIT                   numeric(10,0),
   PENERBIT                       varchar(50),
   LOKASI                         varchar(150),
   STATUS                         smallint,
   primary key (ID_PEMINJAM, ID_ADMIN, KODE_BUKU)
);

/*==============================================================*/
/* Index: MEMINJAM_FK                                           */
/*==============================================================*/
create index MEMINJAM_FK on BUKU
(
   ID_PEMINJAM
);

/*==============================================================*/
/* Index: MENGATUR_FK                                           */
/*==============================================================*/
create index MENGATUR_FK on BUKU
(
   ID_ADMIN
);

/*==============================================================*/
/* Table: CATATAN_PEMINJAMAN                                    */
/*==============================================================*/
create table CATATAN_PEMINJAMAN
(
   ID_PEMINJAM                    int                            not null,
   BUK_ID_PEMINJAM                int                            not null,
   BUK_ID_ADMIN                   int                            not null,
   KODE_BUKU                      varchar(20)                    not null,
   ID_ADMIN                       int                            not null,
   NOMOR_PEMINJAMAN               int                            not null,
   TANGGAL_PEMINJAMAN             datetime,
   TANGGAL_PENGEMBALLIAN          datetime,
   primary key (BUK_ID_PEMINJAM, ID_PEMINJAM, BUK_ID_ADMIN, KODE_BUKU, ID_ADMIN, NOMOR_PEMINJAMAN)
);

/*==============================================================*/
/* Index: TERCATAT_FK                                           */
/*==============================================================*/
create index TERCATAT_FK on CATATAN_PEMINJAMAN
(
   ID_PEMINJAM
);

/*==============================================================*/
/* Index: DICATAT_FK                                            */
/*==============================================================*/
create index DICATAT_FK on CATATAN_PEMINJAMAN
(
   BUK_ID_PEMINJAM,
   BUK_ID_ADMIN,
   KODE_BUKU
);

/*==============================================================*/
/* Index: MEMERIKSA_FK                                          */
/*==============================================================*/
create index MEMERIKSA_FK on CATATAN_PEMINJAMAN
(
   ID_ADMIN
);

/*==============================================================*/
/* Table: PEMINJAM                                              */
/*==============================================================*/
create table PEMINJAM
(
   ID_PEMINJAM                    int                            not null,
   NAMA                           char(50),
   JENIS_KELAMIN                  char(50),
   ALAMAT                         varchar(100),
   NOMOR_TELEPON                  varchar(30),
   primary key (ID_PEMINJAM)
);

alter table BUKU add constraint FK_MEMINJAM foreign key (ID_PEMINJAM)
      references PEMINJAM (ID_PEMINJAM) on delete restrict on update restrict;

alter table BUKU add constraint FK_MENGATUR foreign key (ID_ADMIN)
      references ADMIN (ID_ADMIN) on delete restrict on update restrict;

alter table CATATAN_PEMINJAMAN add constraint FK_DICATAT foreign key (BUK_ID_PEMINJAM, BUK_ID_ADMIN, KODE_BUKU)
      references BUKU (ID_PEMINJAM, ID_ADMIN, KODE_BUKU) on delete restrict on update restrict;

alter table CATATAN_PEMINJAMAN add constraint FK_MEMERIKSA foreign key (ID_ADMIN)
      references ADMIN (ID_ADMIN) on delete restrict on update restrict;

alter table CATATAN_PEMINJAMAN add constraint FK_TERCATAT foreign key (ID_PEMINJAM)
      references PEMINJAM (ID_PEMINJAM) on delete restrict on update restrict;

