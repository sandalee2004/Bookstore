<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567890',
            'address' => '123 Admin Street',
            'city' => 'New York',
            'state' => 'NY',
            'zip_code' => '10001',
            'country' => 'USA',
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        // Create regular user
        User::create([
            'name' => 'John Doe',
            'email' => 'user@bookstore.com',
            'password' => Hash::make('password'),
            'phone' => '+1234567891',
            'address' => '456 User Avenue',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'zip_code' => '90001',
            'country' => 'USA',
            'is_admin' => false,
            'email_verified_at' => now(),
        ]);

        // Create categories
        $categories = [
            [
                'name' => 'Fiction',
                'slug' => 'fiction',
                'description' => 'Novels, short stories, and imaginative literature',
                'image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Non-Fiction',
                'slug' => 'non-fiction',
                'description' => 'Biographies, memoirs, and factual books',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Science Fiction',
                'slug' => 'science-fiction',
                'description' => 'Futuristic and speculative fiction',
                'image' => 'https://images.unsplash.com/photo-1446776653964-20c1d3a81b06?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Mystery & Thriller',
                'slug' => 'mystery-thriller',
                'description' => 'Suspenseful and crime fiction',
                'image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Romance',
                'slug' => 'romance',
                'description' => 'Love stories and romantic fiction',
                'image' => 'https://images.unsplash.com/photo-1518059219734-89d4d4755adc?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business, entrepreneurship, and leadership',
                'image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'Self-Help',
                'slug' => 'self-help',
                'description' => 'Personal development and motivation',
                'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=100&h=100&fit=crop',
            ],
            [
                'name' => 'History',
                'slug' => 'history',
                'description' => 'Historical events and biographies',
                'image' => 'https://images.unsplash.com/photo-1461360370896-922624d12aa1?w=100&h=100&fit=crop',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create authors
        $authors = [
            [
                'name' => 'Stephen King',
                'slug' => 'stephen-king',
                'biography' => 'Stephen Edwin King is an American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels.',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop',
                'birth_date' => '1947-09-21',
                'nationality' => 'American',
            ],
            [
                'name' => 'J.K. Rowling',
                'slug' => 'jk-rowling',
                'biography' => 'Joanne Rowling, better known by her pen name J. K. Rowling, is a British author, philanthropist, film producer, television producer, and screenwriter.',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b1c0?w=400&h=400&fit=crop',
                'birth_date' => '1965-07-31',
                'nationality' => 'British',
            ],
            [
                'name' => 'George R.R. Martin',
                'slug' => 'george-rr-martin',
                'biography' => 'George Raymond Richard Martin, also known as GRRM, is an American novelist and short story writer, screenwriter, and television producer.',
                'photo' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=400&fit=crop',
                'birth_date' => '1948-09-20',
                'nationality' => 'American',
            ],
            [
                'name' => 'Agatha Christie',
                'slug' => 'agatha-christie',
                'biography' => 'Dame Agatha Mary Clarissa Christie was an English writer known for her sixty-six detective novels and fourteen short story collections.',
                'photo' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=400&fit=crop',
                'birth_date' => '1890-09-15',
                'nationality' => 'British',
            ],
            [
                'name' => 'Malcolm Gladwell',
                'slug' => 'malcolm-gladwell',
                'biography' => 'Malcolm Timothy Gladwell is a Canadian journalist, author, and public speaker.',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=400&fit=crop',
                'birth_date' => '1963-09-03',
                'nationality' => 'Canadian',
            ],
            [
                'name' => 'Michelle Obama',
                'slug' => 'michelle-obama',
                'biography' => 'Michelle LaVaughn Robinson Obama is an American attorney and author who served as the first lady of the United States from 2009 to 2017.',
                'photo' => 'https://images.unsplash.com/photo-1494790108755-2616b612b1c0?w=400&h=400&fit=crop',
                'birth_date' => '1964-01-17',
                'nationality' => 'American',
            ],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }

        // Create books
        $books = [
            [
                'title' => 'The Shining',
                'slug' => 'the-shining',
                'description' => 'Jack Torrance\'s new job at the Overlook Hotel is the perfect chance for a fresh start. As the off-season caretaker at the atmospheric old hotel, he\'ll have plenty of time to spend reconnecting with his family and working on his writing.',
                'isbn' => '9780307743657',
                'price' => 15.99,
                'discount_price' => 12.99,
                'stock_quantity' => 25,
                'cover_image' => 'https://images.unsplash.com/photo-1541963463532-d68292c34d19?w=400&h=600&fit=crop',
                'pages' => 688,
                'language' => 'English',
                'publication_date' => '1977-01-28',
                'publisher' => 'Doubleday',
                'rating' => 4.2,
                'reviews_count' => 1250,
                'is_featured' => true,
                'category_id' => 1, // Fiction
                'author_id' => 1, // Stephen King
            ],
            [
                'title' => 'Harry Potter and the Philosopher\'s Stone',
                'slug' => 'harry-potter-philosophers-stone',
                'description' => 'Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle.',
                'isbn' => '9780439708180',
                'price' => 12.99,
                'stock_quantity' => 50,
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'pages' => 309,
                'language' => 'English',
                'publication_date' => '1997-06-26',
                'publisher' => 'Bloomsbury',
                'rating' => 4.7,
                'reviews_count' => 2890,
                'is_featured' => true,
                'category_id' => 1, // Fiction
                'author_id' => 2, // J.K. Rowling
            ],
            [
                'title' => 'A Game of Thrones',
                'slug' => 'game-of-thrones',
                'description' => 'From a master of contemporary fantasy comes the first novel of a landmark series unlike any you\'ve ever read before. With A Game of Thrones, George R. R. Martin has launched a genuine masterpiece.',
                'isbn' => '9780553593716',
                'price' => 18.99,
                'discount_price' => 15.99,
                'stock_quantity' => 30,
                'cover_image' => 'https://images.unsplash.com/photo-1515879218367-8466d910aaa4?w=400&h=600&fit=crop',
                'pages' => 720,
                'language' => 'English',
                'publication_date' => '1996-08-01',
                'publisher' => 'Bantam Books',
                'rating' => 4.4,
                'reviews_count' => 3420,
                'is_featured' => true,
                'category_id' => 1, // Fiction
                'author_id' => 3, // George R.R. Martin
            ],
            [
                'title' => 'Murder on the Orient Express',
                'slug' => 'murder-orient-express',
                'description' => 'Just after midnight, the famous Orient Express is stopped in its tracks by a snowdrift. By morning, the millionaire Samuel Edward Ratchett lies dead in his compartment, stabbed a dozen times, his door locked from the inside.',
                'isbn' => '9780062693662',
                'price' => 14.99,
                'stock_quantity' => 20,
                'cover_image' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=600&fit=crop',
                'pages' => 256,
                'language' => 'English',
                'publication_date' => '1934-01-01',
                'publisher' => 'Collins Crime Club',
                'rating' => 4.1,
                'reviews_count' => 1567,
                'is_featured' => false,
                'category_id' => 4, // Mystery & Thriller
                'author_id' => 4, // Agatha Christie
            ],
            [
                'title' => 'Outliers: The Story of Success',
                'slug' => 'outliers-story-success',
                'description' => 'In this stunning new book, Malcolm Gladwell takes us on an intellectual journey through the world of "outliers"--the best and the brightest, the most famous and the most successful.',
                'isbn' => '9780316017930',
                'price' => 16.99,
                'discount_price' => 13.99,
                'stock_quantity' => 35,
                'cover_image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?w=400&h=600&fit=crop',
                'pages' => 309,
                'language' => 'English',
                'publication_date' => '2008-11-18',
                'publisher' => 'Little, Brown and Company',
                'rating' => 4.0,
                'reviews_count' => 2145,
                'is_featured' => true,
                'category_id' => 6, // Business
                'author_id' => 5, // Malcolm Gladwell
            ],
            [
                'title' => 'Becoming',
                'slug' => 'becoming',
                'description' => 'In a life filled with meaning and accomplishment, Michelle Obama has emerged as one of the most iconic and compelling women of our era. As First Lady of the United States of America, she helped create the most welcoming and inclusive White House in history.',
                'isbn' => '9781524763138',
                'price' => 19.99,
                'discount_price' => 16.99,
                'stock_quantity' => 40,
                'cover_image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=400&h=600&fit=crop',
                'pages' => 448,
                'language' => 'English',
                'publication_date' => '2018-11-13',
                'publisher' => 'Crown Publishing',
                'rating' => 4.6,
                'reviews_count' => 4892,
                'is_featured' => true,
                'category_id' => 2, // Non-Fiction
                'author_id' => 6, // Michelle Obama
            ],
            [
                'title' => 'The Tipping Point',
                'slug' => 'tipping-point',
                'description' => 'The tipping point is that magic moment when an idea, trend, or social behavior crosses a threshold, tips, and spreads like wildfire.',
                'isbn' => '9780316346627',
                'price' => 15.99,
                'stock_quantity' => 25,
                'cover_image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400&h=600&fit=crop',
                'pages' => 301,
                'language' => 'English',
                'publication_date' => '2000-03-01',
                'publisher' => 'Little, Brown and Company',
                'rating' => 3.9,
                'reviews_count' => 1876,
                'is_featured' => false,
                'category_id' => 6, // Business
                'author_id' => 5, // Malcolm Gladwell
            ],
            [
                'title' => 'IT',
                'slug' => 'it-stephen-king',
                'description' => 'Welcome to Derry, Maine. It\'s a small city, a place as hauntingly familiar as your own hometown. Only in Derry the haunting is real.',
                'isbn' => '9781501142970',
                'price' => 17.99,
                'discount_price' => 14.99,
                'stock_quantity' => 18,
                'cover_image' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?w=400&h=600&fit=crop',
                'pages' => 1138,
                'language' => 'English',
                'publication_date' => '1986-09-15',
                'publisher' => 'Viking',
                'rating' => 4.3,
                'reviews_count' => 2567,
                'is_featured' => false,
                'category_id' => 1, // Fiction
                'author_id' => 1, // Stephen King
            ],
            [
                'title' => 'And Then There Were None',
                'slug' => 'and-then-there-were-none',
                'description' => 'First, there were ten—a curious assortment of strangers summoned as weekend guests to a little private island off the coast of Devon.',
                'isbn' => '9780062073488',
                'price' => 13.99,
                'stock_quantity' => 22,
                'cover_image' => 'https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=400&h=600&fit=crop',
                'pages' => 264,
                'language' => 'English',
                'publication_date' => '1939-11-06',
                'publisher' => 'Collins Crime Club',
                'rating' => 4.2,
                'reviews_count' => 1934,
                'is_featured' => false,
                'category_id' => 4, // Mystery & Thriller
                'author_id' => 4, // Agatha Christie
            ],
            [
                'title' => 'Dune',
                'slug' => 'dune',
                'description' => 'Set on the desert planet Arrakis, Dune is the story of the boy Paul Atreides, heir to a noble family tasked with ruling an inhospitable world where the only thing of value is the "spice" melange.',
                'isbn' => '9780441013593',
                'price' => 16.99,
                'stock_quantity' => 28,
                'cover_image' => 'https://images.unsplash.com/photo-1446776653964-20c1d3a81b06?w=400&h=600&fit=crop',
                'pages' => 688,
                'language' => 'English',
                'publication_date' => '1965-08-01',
                'publisher' => 'Chilton Books',
                'rating' => 4.1,
                'reviews_count' => 3245,
                'is_featured' => true,
                'category_id' => 3, // Science Fiction
                'author_id' => 1, // Using Stephen King as placeholder - you can add Frank Herbert later
            ],
            [
                'title' => 'The Seven Husbands of Evelyn Hugo',
                'slug' => 'seven-husbands-evelyn-hugo',
                'description' => 'Aging and reclusive Hollywood movie icon Evelyn Hugo is finally ready to tell the truth about her glamorous and scandalous life.',
                'isbn' => '9781501161933',
                'price' => 14.99,
                'discount_price' => 11.99,
                'stock_quantity' => 32,
                'cover_image' => 'https://images.unsplash.com/photo-1518059219734-89d4d4755adc?w=400&h=600&fit=crop',
                'pages' => 400,
                'language' => 'English',
                'publication_date' => '2017-06-13',
                'publisher' => 'Atria Books',
                'rating' => 4.5,
                'reviews_count' => 2789,
                'is_featured' => true,
                'category_id' => 5, // Romance
                'author_id' => 2, // Using J.K. Rowling as placeholder - you can add Taylor Jenkins Reid later
            ],
            [
                'title' => 'The Midnight Library',
                'slug' => 'midnight-library',
                'description' => 'Between life and death there is a library, and within that library, the shelves go on forever. Every book provides a chance to try another life you could have lived.',
                'isbn' => '9780525559474',
                'price' => 15.99,
                'stock_quantity' => 26,
                'cover_image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=600&fit=crop',
                'pages' => 288,
                'language' => 'English',
                'publication_date' => '2020-08-13',
                'publisher' => 'Viking',
                'rating' => 4.0,
                'reviews_count' => 1523,
                'is_featured' => false,
                'category_id' => 1, // Fiction
                'author_id' => 3, // Using George R.R. Martin as placeholder - you can add Matt Haig later
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin login: admin@bookstore.com / password');
        $this->command->info('User login: user@bookstore.com / password');
    }
}