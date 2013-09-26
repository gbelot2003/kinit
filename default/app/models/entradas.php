<?php

class Entradas extends ActiveRecord {
	public function initialize()
	{
		$this->has_one('seccion', 'entradas', 'fk:seccion_id');
	}

	public function listado()
	{
		$join = "join: INNER JOIN seccion AS s ON (entradas.seccion_id = s.id)";
		$cols = "columns: entradas.id as nid, entradas.titulo, entradas.fecha_envio, entradas.estado, s.seccion";
		$ord   = "order: entradas.id DESC";

		return $this->find($cols, $join, $ord);
	}
}