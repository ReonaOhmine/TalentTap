@extends('agent.layouts.app')

@section('title', 'ユーザー編集')

@section('content')
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
  <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
      <h2 class="text-xl font-semibold text-gray-800">ユーザー編集</h2>
      <select id="status" name="status" class="block p-2.5 border border-gray-300 rounded-lg shadow-sm text-sm">
        <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>アクティブ</option>
        <option value="inactive" {{ $user->status == 'inactive' ? 'selected' : '' }}>非アクティブ</option>
        <option value="pending" {{ $user->status == 'pending' ? 'selected' : '' }}>保留中</option>
      </select>
    </div>
    <form action="{{ route('agent.customer.update', $user->id) }}" method="POST">
      @csrf
      @method('PATCH')
      <div class="grid gap-6 mb-6 lg:grid-cols-1">
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
          <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900">名前</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
          </div>
          <div>
            <label for="initial" class="block mb-2 text-sm font-medium text-gray-900">イニシャル</label>
            <input type="text" id="initial" name="initial" value="{{ $user->initial }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
          </div>
          <div>
            <label for="birthday" class="block mb-2 text-sm font-medium text-gray-900">誕生日</label>
            <input type="date" id="birthday" name="birthday" value="{{ $user->birthday }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
          </div>
          <div>
            <label for="gender" class="block mb-2 text-sm font-medium text-gray-900">性別</label>
            <select id="gender" name="gender" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="男性" {{ $user->gender == '男性' ? 'selected' : '' }}>男性</option>
              <option value="女性" {{ $user->gender == '女性' ? 'selected' : '' }}>女性</option>
            </select>
          </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label for="position" class="block mb-2 text-sm font-medium text-gray-900">ポジション</label>
            <input type="text" id="position" name="position" value="{{ $user->position }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" required>
          </div>
          <div>
            <label for="num_companies_worked" class="block mb-2 text-sm font-medium text-gray-900">経験社数</label>
            <select id="num_companies_worked" name="num_companies_worked" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}" {{ $user->num_companies_worked == $i ? 'selected' : '' }}>{{ $i }}</option>
              @endfor
            </select>
          </div>
        </div>
        <div>
          <label for="catch_copy" class="block mb-2 text-sm font-medium text-gray-900">経歴キャッチコピー</label>
          <input type="text" id="catch_copy" name="catch_copy" value="{{ $user->catch_copy }}" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="60">
        </div>
        <div>
          <label for="career_description" class="block mb-2 text-sm font-medium text-gray-900">経歴概要</label>
          <textarea id="career_description" name="career_description" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="250" rows="4">{{ $user->career_description }}</textarea>
        </div>
        <div>
          <label for="recommendation" class="block mb-2 text-sm font-medium text-gray-900">こんな企業におすすめ</label>
          <textarea id="recommendation" name="recommendation" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">{{ $user->recommendation }}</textarea>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
          <div>
            <label for="skill_distribution_1" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル①</label>
            <select id="skill_distribution_1" name="skill_distribution_1" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA" {{ $user->skill_distribution_1 == 'AAA' ? 'selected' : '' }}>AAA</option>
              <option value="BBB" {{ $user->skill_distribution_1 == 'BBB' ? 'selected' : '' }}>BBB</option>
              <option value="CCC" {{ $user->skill_distribution_1 == 'CCC' ? 'selected' : '' }}>CCC</option>
              <option value="DDD" {{ $user->skill_distribution_1 == 'DDD' ? 'selected' : '' }}>DDD</option>
              <option value="EEE" {{ $user->skill_distribution_1 == 'EEE' ? 'selected' : '' }}>EEE</option>
            </select>
            <label for="skill_comment_1" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント①</label>
            <textarea id="skill_comment_1" name="skill_comment_1" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2">{{ $user->skill_comment_1 }}</textarea>
          </div>
          <div>
            <label for="skill_distribution_2" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル②</label>
            <select id="skill_distribution_2" name="skill_distribution_2" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA" {{ $user->skill_distribution_2 == 'AAA' ? 'selected' : '' }}>AAA</option>
              <option value="BBB" {{ $user->skill_distribution_2 == 'BBB' ? 'selected' : '' }}>BBB</option>
              <option value="CCC" {{ $user->skill_distribution_2 == 'CCC' ? 'selected' : '' }}>CCC</option>
              <option value="DDD" {{ $user->skill_distribution_2 == 'DDD' ? 'selected' : '' }}>DDD</option>
              <option value="EEE" {{ $user->skill_distribution_2 == 'EEE' ? 'selected' : '' }}>EEE</option>
            </select>
            <label for="skill_comment_2" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント②</label>
            <textarea id="skill_comment_2" name="skill_comment_2" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2">{{ $user->skill_comment_2 }}</textarea>
          </div>
          <div>
            <label for="skill_distribution_3" class="block mb-2 text-sm font-medium text-gray-900">特筆スキル③</label>
            <select id="skill_distribution_3" name="skill_distribution_3" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              <option value="AAA" {{ $user->skill_distribution_3 == 'AAA' ? 'selected' : '' }}>AAA</option>
              <option value="BBB" {{ $user->skill_distribution_3 == 'BBB' ? 'selected' : '' }}>BBB</option>
              <option value="CCC" {{ $user->skill_distribution_3 == 'CCC' ? 'selected' : '' }}>CCC</option>
              <option value="DDD" {{ $user->skill_distribution_3 == 'DDD' ? 'selected' : '' }}>DDD</option>
              <option value="EEE" {{ $user->skill_distribution_3 == 'EEE' ? 'selected' : '' }}>EEE</option>
            </select>
            <label for="skill_comment_3" class="block mt-2 mb-2 text-sm font-medium text-gray-900">特筆スキルコメント③</label>
            <textarea id="skill_comment_3" name="skill_comment_3" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm" maxlength="100" rows="2">{{ $user->skill_comment_3 }}</textarea>
          </div>
        </div>
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label for="desired_salary_min" class="block mb-2 text-sm font-medium text-gray-900">希望年収（下限）</label>
            <select id="desired_salary_min" name="desired_salary_min" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 300; $i <= 5000; $i += 50)
                <option value="{{ $i }}" {{ $user->desired_salary_min == $i ? 'selected' : '' }}>{{ $i }}万円</option>
              @endfor
            </select>
          </div>
          <div>
            <label for="desired_salary_max" class="block mb-2 text-sm font-medium text-gray-900">希望年収（上限）</label>
            <select id="desired_salary_max" name="desired_salary_max" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">
              @for ($i = 300; $i <= 5000; $i += 50)
                <option value="{{ $i }}" {{ $user->desired_salary_max == $i ? 'selected' : '' }}>{{ $i }}万円</option>
              @endfor
            </select>
          </div>
        </div>
        <div>
          <label for="work_preference" class="block mb-2 text-sm font-medium text-gray-900">希望の働き方</label>
          <div class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm h-24 overflow-y-scroll">
            @php
              $work_preferences = json_decode($user->work_preference, true) ?? [];
            @endphp
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="リモートワーク" {{ in_array('リモートワーク', $work_preferences) ? 'checked' : '' }}> リモートワーク
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="フレックスタイム" {{ in_array('フレックスタイム', $work_preferences) ? 'checked' : '' }}> フレックスタイム
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="週休三日制" {{ in_array('週休三日制', $work_preferences) ? 'checked' : '' }}> 週休三日制
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="時短勤務" {{ in_array('時短勤務', $work_preferences) ? 'checked' : '' }}> 時短勤務
            </label>
            <label class="block mb-2">
              <input type="checkbox" name="work_preference[]" value="副業可" {{ in_array('副業可', $work_preferences) ? 'checked' : '' }}> 副業可
            </label>
          </div>
        </div>
        <div>
          <label for="notable_achievements" class="block mb-2 text-sm font-medium text-gray-900">主な実績</label>
          <textarea id="notable_achievements" name="notable_achievements" class="block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm">{{ $user->notable_achievements }}</textarea>
        </div>
      </div>
      <div class="flex justify-end space-x-4">
        <a href="{{ route('agent.customer.index') }}" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50">
          キャンセル
        </a>
        <button type="submit" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
          更新
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
