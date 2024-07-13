@extends('employer.layouts.app')

@section('title', '求職者情報')

@section('content')
    <div class="container mx-auto">
        <h1 class="text-xl font-bold mb-4">求職者情報</h1>
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
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-bold text-lg" id="modal-title">詳細情報</h3>
                <button class="btn btn-sm btn-circle" onclick="closeModal()">✕</button>
            </div>
            <div class="py-4" id="modal-details">
                <div class="flex items-center">
                    <div class="flex-none w-24">
                        <img id="profile-picture" src="" alt="Profile Picture" class="rounded-full">
                    </div>
                    <div class="ml-4 flex flex-col">
                        <p class="text-lg font-semibold" id="modal-name-age-gender"></p>
                        <p class="text-sm text-gray-600" id="modal-job-description"></p>
                    </div>
                    <div class="ml-auto text-right">
                        <h4 class="font-bold text-md mb-2">経験企業数</h4>
                        <p class="text-gray-700" id="modal-num-companies-worked"></p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="text-lg font-bold text-blue-700" id="modal-catch-copy"></p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-md mb-2">職務要約</h4>
                    <p class="text-gray-700" id="modal-career-description"></p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-md mb-2">特に得意な領域</h4>
                    <div class="text-gray-700" id="modal-skill-map"></div>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-md mb-2">過去実績</h4>
                    <p class="text-gray-700" id="modal-notable-achievements"></p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-md mb-2">希望年収</h4>
                    <p class="text-gray-700" id="modal-desired-salary"></p>
                </div>
                <div class="mt-4">
                    <h4 class="font-bold text-md mb-2">職務の希望</h4>
                    <p class="text-gray-700" id="modal-work-preference"></p>
                </div>
            </div>
            <div class="modal-action">
                <button class="btn" onclick="closeModal()">閉じる</button>
            </div>
        </div>
    </div>

    <!-- 新しいポップアップモーダル -->
    <div id="confirmation-modal" class="modal">
        <div class="modal-box">
            <h3 class="font-bold text-lg">この候補者の希望年収、働き方のを希望を確認しましたか？</h3>
            <div class="modal-action">
                <button id="confirm-yes" class="btn btn-primary">はい、紹介希望のメッセージをします</button>
                <button id="confirm-no" class="btn">いいえ、戻って確認します</button>
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
            white-space: pre-wrap;
        }
        .recommendation {
            -webkit-line-clamp: 4;
            height: 8rem;
            white-space: pre-wrap;
        }

        .modal {
            display: none;
        }

        .modal-open {
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-box {
            max-width: 600px;
            width: 100%;
            background-color: #fff;
            border-radius: 8px;
            padding: 16px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .skill-map-item {
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .skill-map-label {
            font-weight: bold;
            background-color: #4a90e2;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            margin-right: 0.5rem;
        }

        .skill-map-description {
            margin-left: 4px;
        }
    </style>

    <script>
        function calculateAge(birthday) {
            const birthDate = new Date(birthday);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDifference = today.getMonth() - birthDate.getMonth();
            if (monthDifference < 0 || (monthDifference === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        function openModal(id) {
            console.log("Opening modal for candidate with ID:", id);
            fetch(`/api/get-candidate/${id}`)
                .then(response => response.json())
                .then(data => {
                    const age = calculateAge(data.birthday);
                    document.getElementById('modal-title').textContent = '詳細情報';
                    document.getElementById('modal-name-age-gender').textContent = `${data.initial}さん（${age}歳/${data.gender}）`;
                    document.getElementById('modal-job-description').textContent = data.job_description || data.position;
                    document.getElementById('modal-career-description').innerHTML = (data.career_description || '').replace(/\n/g, '<br>');
                    document.getElementById('modal-desired-salary').textContent = `${data.desired_salary_min}万円 - ${data.desired_salary_max}万円`;
                    document.getElementById('modal-notable-achievements').innerHTML = (data.notable_achievements || '').replace(/\n/g, '<br>');
                    document.getElementById('modal-catch-copy').textContent = data.catch_copy;
                    document.getElementById('modal-num-companies-worked').textContent = `${data.num_companies_worked}社`;
                    document.getElementById('modal-work-preference').textContent = data.work_preference;

                    const skillMapContainer = document.getElementById('modal-skill-map');
                    skillMapContainer.innerHTML = '';
                    for (let i = 1; i <= 3; i++) {
                        const skillDistribution = data[`skill_distribution_${i}`];
                        const skillComment = data[`skill_comment_${i}`];
                        if (skillDistribution) {
                            const skillItem = document.createElement('div');
                            skillItem.className = 'skill-map-item';
                            skillItem.innerHTML = `
                                <span class="skill-map-label">${skillDistribution}</span>
                                <span class="skill-map-description">${skillComment || ''}</span>
                            `;
                            skillMapContainer.appendChild(skillItem);
                        }
                    }

                    const profilePicture = document.getElementById('profile-picture');
                    if (data.gender === '男性') {
                        profilePicture.src = '/photo/boy.png';
                    } else if (data.gender === '女性') {
                        profilePicture.src = '/photo/girl.png';
                    } else {
                        profilePicture.src = '/images/profile-picture.png';
                    }

                    document.getElementById('modal').classList.add('modal-open');
                })
                .catch(error => {
                    console.error('Error fetching candidate details:', error);
                    alert('候補者の詳細を取得する際にエラーが発生しました。');
                });
        }

        function closeModal() {
            document.getElementById('modal').classList.remove('modal-open');
        }

        function openConfirmationModal(candidateId, agentId) {
            const confirmationModal = document.getElementById('confirmation-modal');
            confirmationModal.classList.add('modal-open');

            document.getElementById('confirm-yes').onclick = function() {
                window.location.href = `/employer/messages?receiver_id=${agentId}`;
            }

            document.getElementById('confirm-no').onclick = function() {
                confirmationModal.classList.remove('modal-open');
                window.location.href = '/employer/customer/search';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const candidates = [];
            let currentPage = 1;
            const itemsPerPage = 3;

            function fetchCandidates() {
                console.log("Fetching candidates...");
                fetch('https://freddy.sakura.ne.jp/TalentTap/employer/customer/date')
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
                                age: calculateAge(customer.birthday),
                                gender: customer.gender,
                                jobDescription: customer.job_description || customer.position,
                                salaryMin: customer.desired_salary_min,
                                salaryMax: customer.desired_salary_max,
                                summary: customer.catch_copy || '',
                                details: customer.career_description || '',
                                recommendation: customer.recommendation || '',
                                match: customer.match_percentage,
                                agentId: customer.agent_id
                            });
                        });
                        console.log("Candidates:", candidates);
                        displayCandidates();
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        document.getElementById('search-results').innerHTML = '<p>データの取得中にエラーが発生しました。サーバーの状態を確認してください。</p>';
                    });
            }

            function displayCandidates() {
                const searchResults = document.getElementById('search-results');
                searchResults.innerHTML = '';

                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const candidatesToDisplay = candidates.slice(startIndex, endIndex);

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
                                <p class="text-gray-700 card-text details">${candidate.details.replace(/\n/g, '<br>')}</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg mb-4 h-fixed-smaller">
                                <h3 class="text-xl font-semibold mb-2">こんな企業におすすめ</h3>
                                <p class="text-gray-700 card-text recommendation">${candidate.recommendation.replace(/\n/g, '<br>')}</p>
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
                                <button class="btn btn-success" style="background-color: #ACF216; border-color: #ACF216;" onclick="openConfirmationModal('${candidate.id}', '${candidate.agentId}')">紹介してもらう</button>
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
                document.getElementById('next-page').disabled = currentPage === Math.ceil(candidates.length / itemsPerPage);
            }

            fetchCandidates();

            document.getElementById('prev-page').addEventListener('click', function () {
                if (currentPage > 1) {
                    currentPage--;
                    displayCandidates();
                }
            });

            document.getElementById('next-page').addEventListener('click', function () {
                if (currentPage < Math.ceil(candidates.length / itemsPerPage)) {
                    currentPage++;
                    displayCandidates();
                }
            });
        });
    </script>
@endsection
