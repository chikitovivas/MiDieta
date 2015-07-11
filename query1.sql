SELECT historial.idHistorial as id, historial.Tipo_Comida_id as id_comida, historial.total_calorias as calorias, 
historial.total_carbohidratos as carbohidratos, historial.total_indiceg as indiceg
FROM historial, users
WHERE users.id = 4 and historial.fecha = '2015-06-07';

SELECT alimentos.nombre as comida, alimentos.calorias as calorias, alimentos.carbohidratos as carbohidratos,
alimentos.indiceg as indiceg
FROM (SELECT historial_has_alimentos.Alimentos_id as id FROM historial_has_alimentos 
								WHERE historial_has_alimentos.Historial_id = 2) as ali, alimentos
WHERE alimentos.idAlimentos = ali.id;

SELECT alimentos.idAlimentos as id, alimentos.nombre as comida
FROM alimentos
ORDER BY idAlimentos ASC;