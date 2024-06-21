<?php

declare(strict_types=1);

namespace Tests;

use App\Models\Loan;;
use Laravel\Lumen\Testing\DatabaseMigrations;

class LoanTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateLoan(): void
    {
        $leanData = [
            'borrower_name' => 'Ivan',
            'borrow_volume' => '20000',
            'borrow_date' => '2022-01-01',
            'monthly_payment' => '2000',
        ];
        $loan = Loan::factory()->create($leanData);
        $response = $this->post('/api/loans', $leanData);

        $response->seeStatusCode(201);
        $response->seeJson([
            'borrower_name' => 'Ivan',
            'borrow_volume' => '20000',
            'borrow_date' => '2022-01-01',
            'monthly_payment' => '2000',
        ]);
        $this->seeInDatabase('loans', $leanData);

    }

    public function testShowLoan(): void
    {
        $loan = Loan::factory()->create([
            'id' => '123e4567-e89b-12d3-a456-426614174000',
            'borrower_name' => 'Anton',
            'borrow_volume' => '10000',
            'borrow_date' => '2012-01-01',
            'monthly_payment' => '300',
        ]);
        $response = $this->get('/api/loans/123e4567-e89b-12d3-a456-426614174000');

        $response->seeStatusCode(200);
        $response->seeJson([
            'borrower_name' => 'Anton',
            'borrow_volume' => 10000,
            'borrow_date' => '2012-01-01',
            'monthly_payment' => 300,
        ]);
    }

    public function testUpdateLoan(): void
    {
        $leanData = [
            'borrower_name' => 'Zulfiya',
            'borrow_volume' => '90000',
            'borrow_date' => '1234-11-07',
            'monthly_payment' => '15000',
        ];
        $loan = Loan::factory()->create(
            ['id' => '123e4567-e89b-12d3-a456-426614174000',
                'borrower_name' => 'Ivan',
                'borrow_volume' => '20000',
                'borrow_date' => '2022-01-01',
                'monthly_payment' => '2000',
            ]
        );
        $response = $this->put('/api/loans/123e4567-e89b-12d3-a456-426614174000', $leanData);
        $response->seeStatusCode(200);
        $response->seeJson($leanData);

        $this->seeInDatabase('loans', $leanData);
    }

    public function testDeleteLoan(): void
    {
        $loan = Loan::factory()->create(
            [
                'id' => '123e4567-e89b-12d3-a456-426614174000',
                'borrower_name' => 'Ivan',
                'borrow_volume' => '20000',
                'borrow_date' => '2022-01-01',
                'monthly_payment' => '2000',
            ]
        );
        $response = $this->delete('/api/loans/123e4567-e89b-12d3-a456-426614174000');
        $response->seeStatusCode(204);
        $response->notSeeInDatabase('loans', ['id' => '123e4567-e89b-12d3-a456-426614174000']);
    }

    public function testLoanList(): void
    {
        $loan1 = Loan::factory()->create(
            [
                'borrower_name' => 'Ivan',
                'borrow_volume' => '30000',
                'borrow_date' => '2022-01-01',
                'monthly_payment' => '2000',
            ]
        );
        $loan2 = Loan::factory()->create(
            [
                'borrower_name' => 'Zilfiya',
                'borrow_volume' => '40000',
                'borrow_date' => '2020-01-01',
                'monthly_payment' => '4000',
            ]
        );
        $response = $this->get('/api/loans/');

        $response->seeStatusCode(200);
        $response->seeJson([
            'borrower_name' => 'Ivan',
            'borrow_volume' => 30000,
            'borrow_date' => '2022-01-01',
            'monthly_payment' => 2000,
        ])->seeJson([
            'borrower_name' => 'Zilfiya',
            'borrow_volume' => 40000,
            'borrow_date' => '2020-01-01',
            'monthly_payment' => 4000,
        ]);
    }
}
