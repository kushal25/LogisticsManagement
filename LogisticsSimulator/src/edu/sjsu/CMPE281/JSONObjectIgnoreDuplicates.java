package edu.sjsu.CMPE281;

import org.json.JSONException;
import org.json.JSONObject;

public class JSONObjectIgnoreDuplicates extends JSONObject
{
	public boolean isDuplicateExists = false;
	public JSONObjectIgnoreDuplicates(String json) throws JSONException
	{
		super(json);
	}

	public JSONObject putOnce(String key, Object value)
	{
		Object storedValue;
		if (key != null && value != null)
		{
			if ((storedValue = this.opt(key)) != null)
			{
				if (!storedValue.equals(value)) // Only through Exception for different values with same key
				{
					isDuplicateExists = true;
					return null;
				} else
					return this;
			}
			// add it
			try
			{
				this.put(key, value);
			} catch (JSONException e)
			{
				e.printStackTrace();
			}
		}
		return this;
	}
}
