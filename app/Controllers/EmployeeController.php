<?php

namespace App\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class EmployeeController extends BaseController
{
    private ?Employee $model = null;

    /**
     * Define properties.
     */
    public function __construct()
    {
        $this->model = new Employee();
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */
    public function index(): string
    {
        $action = 'LIST';

        try {
            $employees = $this->model->findAll();
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        return view('content', compact('action', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return string
     */
    public function create(): string
    {
        $action = 'CREATE';

        return view('content', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return ResponseInterface
     */
    public function store(): ResponseInterface
    {
        $this->model->db->transBegin();

        try {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'position'  => $this->request->getPost('position'),
                'created_at'  => Carbon::now('Asia/Bangkok'),
            ];

            $this->model->insert($data);

            $this->model->db->transCommit();
        } catch (Exception $e) {
            $this->model->db->transRollback();

            exit($e->getMessage());
        }

        return $this->response->redirect(site_url('/employees'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function show(int $id): string
    {
        $action = 'SHOW';

        try {
            $employee = $this->model->find($id);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        return view('content', compact('action', 'employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return string
     */
    public function edit(int $id): string
    {
        $action = 'EDIT';

        try {
            $employee = $this->model->find($id);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        return view('content', compact('action', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return ResponseInterface
     */
    public function update(): ResponseInterface
    {
        $this->model->db->transBegin();

        try {
            $data = [
                'first_name' => $this->request->getPost('first_name'),
                'last_name'  => $this->request->getPost('last_name'),
                'position'  => $this->request->getPost('position'),
            ];

            $this->model->update($this->request->getPost('id'), $data);

            $this->model->db->transCommit();
        } catch (Exception $e) {
            $this->model->db->transRollback();

            exit($e->getMessage());
        }

        return $this->response->redirect(site_url('/employees'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return ResponseInterface
     */
    public function destroy(int $id): ResponseInterface
    {
        $this->model->db->transBegin();

        try {
            $this->model->delete($id);

            $this->model->db->transCommit();
        } catch (Exception $e) {
            $this->model->db->transRollback();

            exit($e->getMessage());
        }

        return $this->response->redirect(site_url('/employees'));
    }
}
