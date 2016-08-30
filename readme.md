test project

https://github.com/PaoloFra/SOS_test


http://sos.destyle.com.ua/


SELECT COUNT(DISTINCT tt.id) FROM
(
SELECT 
ts.id, tr.ndc, COUNT(tr.ndc) FROM `tb_source` ts
LEFT JOIN `tb_rel` tr ON tr.cx=ts.cx
-- WHERE ts.id < 300000
GROUP BY ts.id, tr.ndc
HAVING COUNT(tr.ndc)>2
) tt


memory_limit = 2048M
post_max_size = 128M