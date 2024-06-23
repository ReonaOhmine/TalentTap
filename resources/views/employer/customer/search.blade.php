@extends('employer.layouts.app')

@section('title', '求職者情報')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-4">求職者情報</h1>
        <div class="collapse collapse-arrow border border-base-300 bg-base-100 rounded-box">
            <input type="checkbox" class="peer" />
            <div class="collapse-title text-xl font-medium">
                検索条件
            </div>
            <div class="collapse-content">
                <form id="search-form" class="grid grid-cols-1 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    <div class="col-span-1 lg:col-span-2">
                        <input type="text" id="keyword" placeholder="フリーワード検索" class="input input-bordered w-full" />
                    </div>
                    <div>
                        <input type="number" id="age-min" placeholder="年齢（下限）" class="input input-bordered w-full" />
                    </div>
                    <div>
                        <input type="number" id="age-max" placeholder="年齢（上限）" class="input input-bordered w-full" />
                    </div>
                    <div>
                        <input type="number" id="salary-min" placeholder="希望年収（下限）" class="input input-bordered w-full" />
                    </div>
                    <div>
                        <input type="number" id="salary-max" placeholder="希望年収（上限）" class="input input-bordered w-full" />
                    </div>
                    <div>
                        <select id="gender" class="select select-bordered w-full">
                            <option value="">性別</option>
                            <option value="男性">男性</option>
                            <option value="女性">女性</option>
                        </select>
                    </div>
                    <div class="col-span-1 lg:col-span-2">
                        <select id="job-types" class="select select-bordered w-full" multiple>
                            <option value="マーケター">マーケター</option>
                            <option value="デジタルマーケティング">デジタルマーケティング</option>
                            <!-- 他の職種を追加 -->
                        </select>
                    </div>
                    <div>
                        <select id="sort-by" class="select select-bordered w-full">
                            <option value="">ソート</option>
                            <option value="age">年齢</option>
                            <option value="salary">希望年収</option>
                            <option value="match">マッチ度</option>
                        </select>
                    </div>
                    <div class="col-span-1 lg:col-span-2">
                        <button type="submit" class="btn btn-primary w-full" style="background-color: #6C63FF; border-color: #6C63FF;">検索</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <main class="container mx-auto p-6">
        <!-- 検索結果表示エリア -->
        <div id="search-results" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"></div>
        <!-- 検索結果が見つからない場合のメッセージ -->
        <div id="no-results" class="hidden text-center text-gray-500 mt-6">
            <p>検索結果が見つかりませんでした。</p>
        </div>
        <!-- ページング -->
        <div id="pagination" class="flex justify-center mt-6">
            <button id="prev-page" class="btn btn-outline mx-2" style="border-color: #E5E7EB; color: #6B7280;">Prev</button>
            <button id="next-page" class="btn btn-outline mx-2" style="border-color: #E5E7EB; color: #6B7280;">Next</button>
        </div>
    </main>

    <!-- モーダル -->
    <div id="modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg" id="modal-name"></h3>
            <p class="py-4" id="modal-details">ここに詳細情報が表示されます。</p>
            <div class="modal-action">
                <button class="btn" onclick="closeModal()" style="background-color: #6C63FF; border-color: #6C63FF;">閉じる</button>
            </div>
        </div>
    </div>

    <style>
        .card-text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .summary {
            -webkit-line-clamp: 3;
            height: 5rem;
            color: #2256F2;
            font-weight: bold;
        }
        .details {
            -webkit-line-clamp: 8;
            height: 16rem;
            white-space: pre-wrap; /* 追加 */
        }
        .recommendation {
            -webkit-line-clamp: 4;
            height: 8rem;
            white-space: pre-wrap; /* 追加 */
        }
    </style>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const candidates = [];
    let currentPage = 1;
    const itemsPerPage = 3;
    let filteredCandidates = [];

    function fetchCandidates() {
        console.log("Fetching candidates...");
        fetch('/employer/customer/data')
            .then(response => {
                if (!response.ok) {
                    console.error('Network response was not ok:', response.statusText);
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log("Data fetched:", data);
                data.forEach(customer => {
                    candidates.push({
                        id: customer.id,
                        name: (customer.initial || '') + 'さん',
                        age: customer.age,
                        gender: customer.gender,
                        jobDescription: customer.job_description || '',
                        salaryMin: customer.desired_salary_min,
                        salaryMax: customer.desired_salary_max,
                        summary: customer.catch_copy || '',
                        details: customer.career_description || '',
                        recommendation: customer.recommendation || '',
                        match: customer.match_percentage
                    });
                });
                console.log("Candidates:", candidates);
                filterAndDisplayCandidates();
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                document.getElementById('search-results').innerHTML = '<p>データの取得中にエラーが発生しました。サーバーの状態を確認してください。</p>';
            });
    }

    function filterAndDisplayCandidates() {
        const keyword = document.getElementById('keyword').value.toLowerCase();
        const ageMin = document.getElementById('age-min').value;
        const ageMax = document.getElementById('age-max').value;
        const salaryMin = document.getElementById('salary-min').value;
        const salaryMax = document.getElementById('salary-max').value;
        const gender = document.getElementById('gender').value;
        const jobTypes = Array.from(document.getElementById('job-types').selectedOptions).map(option => option.value);
        const sortBy = document.getElementById('sort-by').value;

        console.log("Filtering candidates...");
        filteredCandidates = candidates.filter(candidate => {
            let isVisible = true;

            if (keyword && !(candidate.jobDescription.toLowerCase().includes(keyword) || candidate.summary.toLowerCase().includes(keyword))) {
                isVisible = false;
            }

            if (ageMin && candidate.age < ageMin) {
                isVisible = false;
            }

            if (ageMax && candidate.age > ageMax) {
                isVisible = false;
            }

            if (salaryMin && candidate.salaryMin < salaryMin) {
                isVisible = false;
            }

            if (salaryMax && candidate.salaryMax > salaryMax) {
                isVisible = false;
            }

            if (gender && candidate.gender !== gender) {
                isVisible = false;
            }

            if (jobTypes.length > 0 && !jobTypes.includes(candidate.jobDescription)) {
                isVisible = false;
            }

            return isVisible;
        });

        if (sortBy) {
            filteredCandidates.sort((a, b) => {
                if (sortBy === 'age') {
                    return a.age - b.age;
                } else if (sortBy === 'salary') {
                    return a.salaryMin - b.salaryMin;
                } else if (sortBy === 'match') {
                    return b.match - a.match;
                }
            });
        }

        displayCandidates();
    }

    function displayCandidates() {
        const searchResults = document.getElementById('search-results');
        searchResults.innerHTML = '';

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const candidatesToDisplay = filteredCandidates.slice(startIndex, endIndex);

        if (candidatesToDisplay.length === 0) {
            document.getElementById('no-results').classList.remove('hidden');
        } else {
            document.getElementById('no-results').classList.add('hidden');
            candidatesToDisplay.forEach(candidate => {
                const card = document.createElement('div');
                card.className = 'bg-white shadow rounded-lg p-6 candidate-card';
                card.setAttribute('data-job-description', candidate.jobDescription.toLowerCase());
                card.setAttribute('data-age', candidate.age);
                card.setAttribute('data-gender', candidate.gender);
                card.innerHTML = `
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold">${candidate.name}</h2>
                        <p class="text-lg text-gray-700">（${candidate.age}歳 / ${candidate.gender}）</p>
                    </div>
                    <p class="text-green-600 text-lg mb-4 card-text summary">${candidate.summary}</p>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4 h-fixed">
                        <h3 class="text-xl font-semibold mb-2">職務要約</h3>
                        <p class="text-gray-700 card-text details">${candidate.details}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4 h-fixed-smaller">
                        <h3 class="text-xl font-semibold mb-2">こんな企業におすすめ</h3>
                        <p class="text-gray-700 card-text recommendation">${candidate.recommendation}</p>
                    </div>
                    <div class="flex mb-4">
                        <div class="bg-gray-100 p-4 rounded-lg w-1/2 mr-2">
                            <h3 class="text-xl font-semibold mb-2">希望年収</h3>
                            <p class="text-gray-700">${candidate.salaryMin}万円 - ${candidate.salaryMax}万円</p>
                        </div>
                        <div class="bg-gray-100 p-4 rounded-lg w-1/2 ml-2">
                            <h3 class="text-xl font-semibold mb-2">御社とのマッチ度</h3>
                            <p class="text-gray-700">${candidate.match}%</p>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <button class="btn btn-secondary" onclick="openModal('${candidate.id}')" style="background-color: #446FF2; border-color: #446FF2;">詳細を見る</button>
                        <button class="btn btn-success" style="background-color: #ACF216; border-color: #ACF216;">紹介してもらう</button>
                        <button class="btn btn-outline border-red-600 text-red-600 hover:bg-red-600 hover:text-white" style="border-color: #F27649; color: #F27649;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>
                `;
                searchResults.appendChild(card);
            });
        }

        document.getElementById('prev-page').disabled = currentPage === 1;
        document.getElementById('next-page').disabled = currentPage === Math.ceil(filteredCandidates.length / itemsPerPage);
    }

    window.openModal = function (id) {
        console.log("Opening modal for candidate with ID:", id);
        fetch(`/api/get-candidate/${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('modal-name').textContent = `${data.initial}さん（${data.age}歳/${data.gender}）の詳細情報`;
                document.getElementById('modal-details').innerHTML = `
                <p>${data.catch_copy}</p>
                    <p>職務要約: ${data.career_description}</p>
                    <p>希望年収: ${data.desired_salary_min}万円 - ${data.desired_salary_max}万円</p>                
                    <p>経験企業数: ${data.num_companies_worked}</p>
                    <p>スキル配分: ${data.skill_distribution}</p>
                    <p>過去実績: ${data.notable_achievements}</p>
                `;
                document.getElementById('modal').classList.add('modal-open');
            })
            .catch(error => {
                console.error('Error fetching candidate details:', error);
                alert('候補者の詳細を取得する際にエラーが発生しました。');
            });
    }

    window.closeModal = function () {
        document.getElementById('modal').classList.remove('modal-open');
    }

    document.getElementById('search-form').addEventListener('submit', function (e) {
        e.preventDefault();
        console.log("Search form submitted");
        currentPage = 1;
        filterAndDisplayCandidates();
    });

    document.getElementById('prev-page').addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            displayCandidates();
        }
    });

    document.getElementById('next-page').addEventListener('click', function () {
        if (currentPage < Math.ceil(filteredCandidates.length / itemsPerPage)) {
            currentPage++;
            displayCandidates();
        }
    });

    fetchCandidates();
});
    </script>
@endsection
