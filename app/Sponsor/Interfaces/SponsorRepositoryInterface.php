<?php
namespace App\Sponsor\Interfaces;

interface SponsorRepositoryInterface
{
	public function all();

	public function create($data=[]);
}