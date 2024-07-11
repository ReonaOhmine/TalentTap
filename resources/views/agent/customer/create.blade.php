@extends('agent.layouts.app')

@section('title', 'ユーザー追加')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold text-gray-800">ユーザー追加</h2>
      <select id="status" name="status" class="block p-2.5 border border-gray-300 rounded-lg shadow-sm text-sm">
        <option value="active">アクティブ</option>
        <option value="inactive">非アクティブ</option>
        <option value="pending">保留中</option>
      </select>
    </div>

    <!-- バリデーションエラーの表示 -->
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('agent.customer.store') }}" method="POST">
      @csrf
      <div class="grid gap-6 mb-6 lg:grid-cols-1">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
          <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">名前</label>
            <input type="text" id="name" name="name" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" placeholder="山田 太郎" required>
          </div>
          <div>
            <label for="initial" class="block mb-2 text-sm font-medium text-gray-900">イニシャル</label>
            <input type="text" id="initial" name="initial" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" placeholder="T.Y">
          </div>
          <div>
            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">誕生日</label>
            <input type="date" id="birthday" name="birthday" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
          </div>
          <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">性別</label>
            <select id="gender" name="gender" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="男性">男性</option>
              <option value="女性">女性</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">ポジション</label>
            <input type="text" id="position" name="position" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" placeholder="開発者" required>
          </div>
          <div>
            <label for="num_companies_worked" class="block mb-2 text-sm font-medium text-gray-900">経験社数</label>
            <select id="num_companies_worked" name="num_companies_worked" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
              @endfor
            </select>
          </div>
        </div>
        <div>
          <label for="catch_copy" class="block mb-2 text-sm font-medium text-gray-900">経歴キャッチコピー</label>
          <input type="text" id="catch_copy" name="catch_copy" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="60" placeholder="事業開発、戦略策定など上流経験豊富ながら、CRM/AD領域は実務対応も可能なジェネラリスト">
        </div>
        <div>
          <label for="career_description" class="block mb-2 text-sm font-medium text-gray-900">経歴概要</label>
          <textarea id="career_description" name="career_description" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="250" rows="4" placeholder="東急株式会社入社。OOH やイベント、流通対策等のオフラインを活用したプロモーションの企画、営業を担当。その後、ホテル・リゾートの事業部で会員制リゾートのブランド戦略、広告宣伝業務とリゾート開発の事業企画に従事。開発では、主にタイムシェア、分譲ホテルコンド等の新規事業を担当。その後社内起業家育成制度を活用して屋外広告事業の社内ベンチャーを立ち上げ、事業責任者を務める。2022年に起業。2Bの特にリードナーチャリングやMA,SFA導入支援、Bigqueryなどを活用したデータ統合・可視化、分析など"></textarea>
        </div>
        <div>
          <label for="recommendation" class="block mb-2 text-sm font-medium text-gray-900">こんな企業におすすめ</label>
          <textarea id="recommendation" name="recommendation" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" placeholder="・新規事業立ち上げを検討している
・オフラインのマーケティングも必要としている
・CRMやSFAなどの業務改善ツール導入を検討している/導入しているが上手く使いこなせていない"></textarea>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div>
            <label for="skill_distribution_1" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル①</label>
            <select id="skill_distribution_1" name="skill_distribution_1" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA">AAA</option>
              <option value="BBB">BBB</option>
              <option value="CCC">CCC</option>
              <option value="DDD">DDD</option>
              <option value="EEE">EEE</option>
            </select>
            <label for="skill_comment_1" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント①</label>
            <textarea id="skill_comment_1" name="skill_comment_1" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2"></textarea>
          </div>
          <div>
            <label for="skill_distribution_2" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル②</label>
            <select id="skill_distribution_2" name="skill_distribution_2" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA">AAA</option>
              <option value="BBB">BBB</option>
              <option value="CCC">CCC</option>
              <option value="DDD">DDD</option>
              <option value="EEE">EEE</option>
            </select>
            <label for="skill_comment_2" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント②</label>
            <textarea id="skill_comment_2" name="skill_comment_2" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2"></textarea>
          </div>
          <div>
            <label for="skill_distribution_3" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル③</label>
            <select id="skill_distribution_3" name="skill_distribution_3" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA">AAA</option>
              <option value="BBB">BBB</option>
              <option value="CCC">CCC</option>
              <option value="DDD">DDD</option>
              <option value="EEE">EEE</option>
            </select>
            <label for="skill_comment_3" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント③</label>
            <textarea id="skill_comment_3" name="skill_comment_3" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2"></textarea>
          </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label for="desired_salary_min" class="block mb-2 text-sm font-medium text-gray-900">希望年収（下限）</label>
            <select id="desired_salary_min" name="desired_salary_min" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 300; $i <= 5000; $i += 50)
                <option value="{{ $i }}">{{ $i }}万円</option>
              @endfor
            </select>
          </div>
          <div>
            <label for="desired_salary_max" class="block mb-2 text-sm font-medium text-gray-900">希望年収（上限）</label>
            <select id="desired_salary_max" name="desired_salary_max" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 300; $i <= 5000; $i += 50)
                <option value="{{ $i }}">{{ $i }}万円</option>
              @endfor
            </select>
          </div>
        </div>
        <div>
          <label for="work_preference" class="block mb-2 text-sm font-medium text-gray-900">希望の働き方</label>
          <div class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm h-24 overflow-y-scroll">
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="リモートワーク"> リモートワーク
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="フレックスタイム"> フレックスタイム
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="週休三日制"> 週休三日制
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="時短勤務"> 時短勤務
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="副業可"> 副業可
            </label>
          </div>
        </div>
        <div>
          <label for="notable_achievements" class="block mb-2 text-sm font-medium text-gray-900">主な実績</label>
          <textarea id="notable_achievements" name="notable_achievements" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm"></textarea>
        </div>
      </div>
      <div class="flex justify-end space-x-4">
        <a href="{{ route('agent.customer.index') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
          キャンセル
        </a>
        <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
          保存
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
