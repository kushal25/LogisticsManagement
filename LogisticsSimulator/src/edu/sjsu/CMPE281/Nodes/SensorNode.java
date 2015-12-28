package edu.sjsu.CMPE281.Nodes;

import edu.sjsu.CMPE281.Constants;

public class SensorNode
{
	private Sensor[] sensors;
	private int noOfSensors = Constants.NO_OF_SENSORS / Constants.NO_OF_SENSOR_NODES;
	private String sensoreNodeId = null;
	private ControlNode controlNode = null;

	public void init(int sIndex, ControlNode cNode)
	{
		controlNode = cNode;
		int append = (int)(System.currentTimeMillis() % 10000) + sIndex;
		sensoreNodeId = "SENSOR_NODE_" + append;
		sensors = new Sensor[noOfSensors];
		for (int index = 0; index < noOfSensors; index++)
		{
			sensors[index] = new Sensor();
			sensors[index].init(index + append, cNode);
		}
	}

	public String getSensorNodeId()
	{
		return sensoreNodeId;
	}

	public Sensor[] getSensors()
	{
		return sensors;
	}

	public Sensor getSensorById(String sensorId)
	{
		for (int index = 0; index < noOfSensors; index++)
		{
			if (sensors[index].getSensorId() == sensorId)
			{
				return sensors[index];
			}
		}

		return null;
	}

	public void update(long time)
	{
		for (int index = 0; index < noOfSensors; index++)
		{
			sensors[index].update(time);
		}
	}
}