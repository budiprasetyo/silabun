set session old_alter_table=1;
ALTER IGNORE TABLE ref_history_satker
ADD unique INDEX idx_history (id_ref_satker, tahun, bulan);
